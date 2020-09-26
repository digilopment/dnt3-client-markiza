<?php

namespace DntJobs;

use DntLibrary\Base\DB;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Vendor;
use DntLibrary\Base\Dnt;

class VoyoEmailsUnactiveJob
{

    const UNACTIVE_PERIOD = 4; //WEEK

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
        $logs = [];
        $query = "SELECT msg FROM `dnt_logs` WHERE (`system_status` = 'newsletter_log_seen' OR `system_status` = 'newsletter_log_click') AND vendor_id = '" . $this->vendor->getId() . "'";
        $this->countLogs = $this->db->num_rows($query);
        if ($this->countLogs > 0) {
            $logs = $this->db->get_results($query, true);
        }
        $this->logs = $logs;
    }

    protected function emailsInLogs()
    {
        $emails = [];
        foreach ($this->logs as $log) {
            $email = isset(json_decode($log->msg)->email) ? json_decode($log->msg)->email : false;
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
        $query = "SELECT email FROM `dnt_mailer_mails` WHERE  `vendor_id` = '" . $this->vendor->getId() . "'  AND  cat_id = '" . $this->emailCatId . "' AND `show` = 1 AND datetime_creat < DATE_SUB(NOW(),INTERVAL " . self::UNACTIVE_PERIOD . " WEEK)";
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

    public function run()
    {
        $this->init();
        $this->compare();
        foreach ($this->unactiveEmails as $email) {
            //echo $email.'<br/>';
        }
        var_dump(count($this->unactiveEmails));
    }

}