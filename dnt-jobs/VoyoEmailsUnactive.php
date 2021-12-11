<?php

namespace DntJobs;

use DntLibrary\Base\DB;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Vendor;
use DntLibrary\Base\Dnt;
use mysqli;

class VoyoEmailsUnactiveJob
{

    const UNACTIVE_PERIOD = 20; //DAYS

    protected $emailCatId = 91;
    protected $db;
    protected $vendor;
    protected $countAllEmails;
    protected $logs = [];
    protected $sentEmails = [];
    protected $allEmails = [];
    protected $showEmails = [];
    protected $unactiveEmails = [];

    public function __construct()
    {
        $this->db = new DB();
        $this->rest = new Rest();
        $this->vendor = new Vendor();
    }

    protected function init()
    {
        $this->emailCatId = ($this->rest->get('emailCatId')) ? $this->rest->get('emailCatId') : $this->emailCatId;
        $this->getLogs();
        $this->allEmails();
        $this->showEmails();
        $this->sentEmails();
        $this->emailsInLogs();
    }

    protected function getLogs()
    {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = "SELECT DISTINCT msg FROM `dnt_logs` WHERE vendor_id = '" . $this->vendor->getId() . "'";
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
            $json = json_decode($log);
            $email = isset($json->email) ? $json->email : false;
            $emails[$email] = strtolower($email);
        }
        $this->emailsInLogs = $emails;
    }

    protected function sentEmails()
    {


        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = "SELECT email FROM `dnt_mailer_mails` WHERE  `vendor_id` = '" . $this->vendor->getId() . "'  AND  cat_id = '" . $this->emailCatId . "' AND `show` = 1 AND datetime_creat < DATE_SUB(NOW(),INTERVAL " . self::UNACTIVE_PERIOD . " DAY)";
        $data = [];
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $email);
            while (mysqli_stmt_fetch($stmt)) {
                $data[] = $email;
            }
            mysqli_stmt_close($stmt);
        } else {
            print('no data');
        }
        $this->sentEmails = $data;
    }

    protected function allEmails()
    {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = "SELECT email FROM `dnt_mailer_mails` WHERE  `vendor_id` = '" . $this->vendor->getId() . "'  AND  cat_id = '" . $this->emailCatId . "'";

        $data = [];
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $email);
            while (mysqli_stmt_fetch($stmt)) {
                $data[] = $email;
            }
            mysqli_stmt_close($stmt);
        } else {
            print('no data');
        }
        $this->allEamils = $data;
    }

    protected function showEmails()
    {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = "SELECT email FROM `dnt_mailer_mails` WHERE  `vendor_id` = '" . $this->vendor->getId() . "'  AND  cat_id = '" . $this->emailCatId . "' AND `show` = '1'";

        $data = [];
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $email);
            while (mysqli_stmt_fetch($stmt)) {
                $data[] = $email;
            }
            mysqli_stmt_close($stmt);
        } else {
            print('no data');
        }
        $this->countAllEmails = count($data);
        $this->showEmails = $data;
    }

    protected function compare()
    {

        $inLogs = [];
        foreach ($this->emailsInLogs as $l) {
            $inLogs[] = $l;
        }

        $check = array_count_values(array_merge($this->sentEmails, $inLogs));
        $allUnactive = [];
        foreach ($check as $email => $val) {
            if ($val == 1) {
                $allUnactive[] = $email;
            }
        }
        $check2 = array_count_values(array_merge($allUnactive, $this->showEmails));
        $unactive = [];
        foreach ($check2 as $email => $val) {
            if ($val > 1) {
                $unactive[] = $email;
            }
        }
        $this->unactiveEmails = $unactive;
    }

    public function updateUnactive($emails)
    {

        $updateEmails = [];
        foreach ($emails as $email) {
            $updateEmails[] = "`email` = '" . $email . "'";
        }
        if (count($updateEmails) > 0) {
            $query = 'UPDATE `dnt_mailer_mails` SET `show` = 0, `parent_id` = 1, `datetime_update` = NOW() WHERE `cat_id` = ' . $this->emailCatId . ' AND `vendor_id` = ' . $this->vendor->getId() . ' AND (' . join(' OR ', $updateEmails) . ')';
            //$this->db->query($query);
        }
    }

    public function run()
    {
        $this->init();
        $this->compare();
        $this->updateUnactive($this->unactiveEmails);

        $cUnactive = count($this->unactiveEmails);

        print( 'Comperation emails: ' . count($this->sentEmails) . '<br/>');
        print( 'Total logs: ' . $this->countLogs . '<br/>');
        print('<br/>set as unactive emails: ' . $cUnactive . ' - ALL active emails in database: ' . round($this->countAllEmails - $cUnactive));
    }

}
