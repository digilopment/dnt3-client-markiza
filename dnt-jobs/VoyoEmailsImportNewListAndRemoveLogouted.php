<?php

namespace DntJobs;

use DntLibrary\Base\DB;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Vendor;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Settings;

class VoyoEmailsImportNewListAndRemoveLogoutedJob
{

    const SEARCH_IN_CATS = "91,92,93,95,101";
    const INSERT_TO_CAT = 102;
    const CRM_ID = "newsletter-gdpr-ready-with-old-subscriptions";
    const VENDOR_ID = 39;

    protected $emailCatId = self::INSERT_TO_CAT;
    protected $db;
    protected $dnt;
    protected $vendor;
    protected $activeEmails = [];
    protected $unactiveEmails = [];

    public function __construct()
    {
        $this->db = new DB();
        $this->rest = new Rest();
        $this->vendor = new Vendor();
        $this->dnt = new Dnt();
        $this->settings = new Settings();
        $this->rempService = $this->settings->getGlobals()->vendor['crmService'] . self::CRM_ID;
        $this->rempBareerToken = $this->settings->getGlobals()->vendor['rempBareerToken'];
    }

    protected function init()
    {
        $this->emailCatId = ($this->rest->get('emailCatId')) ? $this->rest->get('emailCatId') : $this->emailCatId;
        $this->logouted();
        $this->newEmails();
    }

    protected function logouted()
    {
        $response = [];
        $query = "SELECT email FROM `dnt_mailer_mails` WHERE cat_id IN(" . self::SEARCH_IN_CATS . ") AND `vendor_id` = '" . $this->vendor->getId() . "'  AND `show` = 0 GROUP BY email";
        $this->countLogoutedEmails = $this->db->num_rows($query);
        if ($this->countLogoutedEmails > 0) {
            $response = $this->db->get_results($query, true);
        }

        foreach ($response as $email) {
            $this->logoutedEmails[] = $email->email;
        }
    }

    protected function getData()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->rempService,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->rempBareerToken,
                'Cookie: PHPSESSID=so1ljg67qism1298aiibe3f24r'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    protected function newEmails()
    {
        $json = json_decode($this->getData(), true);
        $this->jsonEmails = $json['users'];
    }

    protected function isActive($email)
    {
        if (in_array($email, $this->logoutedEmails)) {
            return false;
        }
        return true;
    }

    protected function compare()
    {
        foreach ($this->jsonEmails as $email) {
            if ($this->isActive($email['email'])) {
                $this->activeEmails[] = $email['email'];
            } else {
                $this->unactiveEmails[] = $email['email'];
            }
        }
    }

    protected function writeToDb($email)
    {
        $name = '';
        $surname = '';
        $nickname = '';


        $insertedData = array(
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'title' => $nickname,
            'vendor_id' => self::VENDOR_ID,
            'cat_id' => self::INSERT_TO_CAT,
            '`show`' => 1,
            'datetime_creat' => $this->dnt->datetime(),
            'datetime_update' => $this->dnt->datetime()
        );
        $this->db->insert('dnt_mailer_mails', $insertedData);
    }

    public function run()
    {
        //exit;
        $this->init();
        $this->compare();

        print('count active: ' . count($this->activeEmails) . '<br/><br/>');
        $new = 0;
        foreach ($this->activeEmails as $email) {
            $new++;
            $this->writeToDb($email);
        }
        echo 'New emails inserted: ' . $new . '<br/>';

        var_dump(count($this->activeEmails));
        var_dump(count($this->unactiveEmails));
    }

}
