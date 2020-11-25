<?php

namespace DntJobs;

use DntLibrary\Base\DB;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Settings;

class VoyoEmailsImportRempInfoJob
{

    const CAT_ID = 93;
    const VENDOR_ID = 39;
    const DELETE_PERIOD = 2;

    protected $settings;
    protected $dnt;
    protected $db;
    protected $dbEmails = [];
    protected $jsonEmails = [];

    public function __construct()
    {
        $this->settings = new Settings();
        $this->rempService = 'https://crm.cms.markiza.sk/api/v1/user-segments/users?code=newsletter-gdpr-ready-plus-subscribers';
        $this->rempBareerToken = $this->settings->getGlobals()->vendor['rempBareerToken'];
        $this->dnt = new Dnt();
        $this->db = new DB();
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

    /**
     * vymaze vsetky aktivne emaily[`show` = 1] - v prípade problému ich vieme doimportovat
     */
    protected function deleteAll()
    {
        $query = "DELETE FROM `dnt_mailer_mails` WHERE cat_id = '" . self::CAT_ID . "' AND vendor_id = '" . self::VENDOR_ID . "' AND `show` = 1";
        $this->db->query($query);
    }

    /**
     * odstrani vsetky emaily ktore su starsie ako 1 a su aktivne
     * tie ktore poziadali o zrusenie z DB nemazem z dovodu udrzania informacie o neodosielani emailov
     */
    protected function deleteOneYearOldEmails()
    {
        $query = "DELETE FROM `dnt_mailer_mails` WHERE cat_id = '" . self::CAT_ID . "' AND `show` = 1 AND vendor_id = '" . self::VENDOR_ID . "' AND datetime_creat < DATE_SUB(NOW(),INTERVAL " . self::DELETE_PERIOD . " YEAR)";
        $this->db->query($query);
    }

    /**
     * vytiahne vsetky naimportovane emaily z danej kategorie 
     */
    protected function dbEmails()
    {
        $query = "SELECT email FROM `dnt_mailer_mails` WHERE cat_id = '" . self::CAT_ID . "' AND vendor_id = '" . self::VENDOR_ID . "'";
        foreach ($this->db->get_results($query) as $row) {
            $this->dbEmails[] = $row['email'];
        }
    }

    /**
     * vytiahne vsetky nove emaily z API VOYA
     * data ziskava dovtedy, kym existuje nextId, respektive ak nextId vrati data, dovtedy sa oslovuje VOYO SERVICE
     */
    protected function newEmails()
    {
        $json = json_decode($this->getData(), true);
        $this->jsonEmails = $json['users'];
    }

    /**
     * 
     * zapis do databazy
     */
    protected function writeToDb($item)
    {
        $name = '';
        $surname = '';
        $nickname = '';
        if (isset($item['name'])) {
            $name = str_replace('?', 'c', $item['name']);
        }
        if (isset($item['surname'])) {
            $surname = str_replace('?', 'c', $item['surname']);
        }
        if (isset($item['nickname'])) {
            $nickname = $item['nickname'];
        }
        $email = $item['email'];

        $insertedData = array(
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'title' => $nickname,
            'vendor_id' => self::VENDOR_ID,
            'cat_id' => self::CAT_ID,
            '`show`' => 1,
            'datetime_creat' => $this->dnt->datetime(),
            'datetime_update' => $this->dnt->datetime()
        );
        $this->db->insert('dnt_mailer_mails', $insertedData);
    }

    protected function init()
    {
        //$this->deleteOneYearOldEmails();
        $this->dbEmails();
        $this->newEmails();
    }

    public function run()
    {
        $this->init();
        print('count: ' . count($this->jsonEmails) . '<br/><br/>');
        $new = 0;
        foreach ($this->jsonEmails as $item) {
            if (!in_array($item['email'], $this->dbEmails)) {
                $new++;
                $this->writeToDb($item);
                //print ($item['email'] . ' nie je v databaze a bol zapisany do DB<br/>');
            } else {
                //print ($item['email'] . ' EXISTUJE alebo je DUPLIKAT<br/>');
            }
        }
        echo 'New emails: ' . $new;
    }

}
