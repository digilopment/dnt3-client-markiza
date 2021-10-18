<?php

namespace DntJobs;

use DntLibrary\Base\DB;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Vendor;
use DntLibrary\Base\Dnt;
use mysqli;

class VoyoEmailsUnactiveJob
{

    const UNACTIVE_PERIOD = 28; //DAYS

    protected $emailCatId = 91;
    protected $db;
    protected $dnt;
    protected $vendor;
    protected $logs = [];
    protected $sentEmails = [];
    protected $activeEmails = [];
    protected $unactiveEmails = [];

    public function __construct()
    {
        $this->db = new DB();
        $this->rest = new Rest();
        $this->vendor = new Vendor();
        $this->dnt = new Dnt();
    }

    protected function init()
    {
        $this->emailCatId = ($this->rest->get('emailCatId')) ? $this->rest->get('emailCatId') : $this->emailCatId;
        $this->getLogs();
        $this->sentEmails();
        $this->emailsInLogs();
    }

    protected function getLogs()
    {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = "SELECT msg FROM `dnt_logs` WHERE (`system_status` = 'newsletter_log_seen' OR `system_status` = 'newsletter_log_click') AND vendor_id = '" . $this->vendor->getId() . "'";

        $data = [];
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $msg);
            while (mysqli_stmt_fetch($stmt)) {
                $data[] = $msg;
            }
            mysqli_stmt_close($stmt);
        } else {
            print('no data');
        }

        $countTotalLogs = count($data);
        $this->countLogs = $countTotalLogs;
        $this->logs = $data;
    }

    protected function emailsInLogs()
    {
        $emails = [];
        foreach ($this->logs as $log) {
            $email = isset(json_decode($log)->email) ? json_decode($log)->email : false;
            $emails[$email] = $email;
        }
        $this->emailsInLogs = $emails;
    }

    protected function isActive($email)
    {
        if (in_array($email, $this->emailsInLogs)) {
            return true;
        }
        return false;
    }

    protected function sentEmails()
    {
        $query = "SELECT email FROM `dnt_mailer_mails` WHERE  `vendor_id` = '" . $this->vendor->getId() . "'  AND  cat_id = '" . $this->emailCatId . "' AND `show` = 1 AND datetime_creat < DATE_SUB(NOW(),INTERVAL " . self::UNACTIVE_PERIOD . " DAY)";
        $this->countAllEmails = $this->db->num_rows($query);
        if ($this->countAllEmails > 0) {
            $this->sentEmails = $this->db->get_results($query, true);
        }
    }

    protected function compare()
    {
        foreach ($this->sentEmails as $email) {
            if ($this->isActive($email->email)) {
                $this->activeEmails[] = $email->email;
            } else {
                $this->unactiveEmails[] = $email->email;
            }
        }
    }

    public function updateUnactive($emails)
    {

        $updateEmails = [];
        foreach ($emails as $email) {
            $updateEmails[] = "`email` = '" . $email . "'";
        }
        if (count($updateEmails) > 0) {
            $query = 'UPDATE `dnt_mailer_mails` SET `show` = 0, `parent_id` = 1, `datetime_update` = NOW() WHERE `cat_id` = ' . $this->emailCatId . ' AND `vendor_id` = ' . $this->vendor->getId() . ' AND (' . join(' OR ', $updateEmails) . ')';
            $this->db->query($query);
        }
    }

    public function run()
    {
        $this->init();
        $this->compare();
        $this->updateUnactive($this->unactiveEmails);

        print ('<br/>set as unactive emails: ' . count($this->unactiveEmails) . ' - ALL emails in database: ' . $this->countAllEmails);
    }

}
