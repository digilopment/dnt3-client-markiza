<?php

namespace DntJobs;

use DntLibrary\Base\DB;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Settings;

class VoyoEmailsImportRempJob
{

    const CAT_ID = 91;
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
        $this->rempService = $this->settings->getGlobals()->vendor['rempService'];
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
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = "SELECT email FROM `dnt_mailer_mails` WHERE cat_id = '" . self::CAT_ID . "' AND vendor_id = '" . self::VENDOR_ID . "'";

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
		
        $final = [];
        foreach ($data as $email) {
            $final[strtolower($email)] = strtolower($email);
        }
        $this->dbEmails = $final;
    }

    /**
     * vytiahne vsetky nove emaily z API VOYA
     * data ziskava dovtedy, kym existuje nextId, respektive ak nextId vrati data, dovtedy sa oslovuje VOYO SERVICE
     */
    protected function newEmails()
    {
        $json = json_decode($this->getData(), true);
        $final = [];
        $i = 0;
        foreach ($json['users'] as $item) {
            if ($i < 1000000) {
				$key = strtolower($item['email']);
                $final[$key] = $item;
            }
            $i++;
        }
        $this->jsonEmails = $final;
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
        $email = strtolower($item['email']);

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
	
	protected function createInsertData($item)
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
        $email = strtolower($item['email']);

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
        return $insertedData;
    }

    protected function writeToDbMulti($data)
    {
        $fields = array(
            'name',
            'surname',
            'email',
            'title',
            'vendor_id',
            'cat_id',
            'show',
            'datetime_creat',
            'datetime_update',
        );
        $records = $data;
        if (count($data) > 0) {
			
			//exit;
			/*$sql = $this->db->insert_multi('dnt_mailer_mails', $fields, $data, true);
            $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			//mysqli_begin_transaction($link);
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_execute($stmt);
			//mysqli_commit($link);
			
			echo $sql;
            $this->db->query("UPDATE `dnt_mailer_mails` SET `id_entity`= `id` WHERE id_entity = 0");*/
        }
    }

    protected function init()
    {
        $this->deleteOneYearOldEmails();
        $this->dbEmails();
        $this->newEmails();
    }

    
    public function run()
    {

        $this->init();
        $new = 0;
        $data = [];
        foreach ($this->jsonEmails as $item) {
            if (in_array(strtolower($item['email']), $this->dbEmails)) {
               //$data[] = $this->createInsertData($item);
            } else {
                $data[] = $this->createInsertData($item);
                $new++;
            }
        }
		
		$fields = array(
            'name',
            'surname',
            'email',
            'title',
            'vendor_id',
            'cat_id',
            'show',
            'datetime_creat',
            'datetime_update',
        );
        $records = $data;
		$sql = $this->db->insert_multi('dnt_mailer_mails', $fields, $data, true);
		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_execute($stmt);
		$stmt2 = mysqli_prepare($link, "UPDATE `dnt_mailer_mails` SET `id_entity`= `id` WHERE id_entity = 0");
		mysqli_stmt_execute($stmt2);
		//echo $sql;
		//exit;
        //$this->writeToDbMulti($data);

        print('count JSON emails: ' . count($this->jsonEmails) . '<br/><br/>');
        print('count DATABASE emails: ' . count($this->dbEmails) . '<br/><br/>');
        print('New imported emails: ' . $new);
    }

}
