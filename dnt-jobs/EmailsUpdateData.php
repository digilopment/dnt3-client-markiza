<?php

namespace DntJobs;

use DntLibrary\Base\DB;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Settings;

class EmailsUpdateDataJob
{

    const UNACTIVE_PERIOD = 28; //DAYS

    protected $emailCatId = 91;
    protected $db;
    protected $dnt;
    protected $vendor;
    protected $jsonUsers = [];

    public function __construct()
    {
        $this->settings = new Settings();
        $this->rempService = 'https://crm.cms.markiza.sk/api/v1/user-segments/users-extended?code=all_users';
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
			'Authorization: Bearer ' . $this->rempBareerToken ,
			'Cookie: PHPSESSID=so1ljg67qism1298aiibe3f24r; n_token=3555a51648ca6e8e653d8b9d6290d798; n_version=3'
		  ),
		));

		$response = curl_exec($curl);
        return $response;
    }

    protected function newEmails()
    {
        //$json = json_decode($this->getData(), true);
		file_put_contents('data.json', $this->getData());
		exit;
        $users = $json['users'];
		foreach($users as $user){
			if( (isset($user['first_name']) && !empty($user['first_name'])) ||  (isset($user['last_name']) && !empty($user['last_name'])) ){
				$badfirst_name = str_replace('?', '-', $user['first_name']);
				$badlast_name = str_replace('?', '-', $user['last_name']);
				if($this->dnt->in_string('-', $badfirst_name) || $this->dnt->in_string('-', $badlast_name)){
					$this->jsonUsers[] = $user;
				}
			}
		}
    }

    protected function init()
    {
        $this->newEmails();
    }

    public function run()
    {
        $this->init();
        //var_dump(count($this->jsonUsers));
		foreach($this->jsonUsers as $user){
			$data[] = $user['id'].';'.$user['email'].';'.$user['first_name'].';'.$user['last_name'].';'.$user['email'].'<br/>';
		}
		file_put_contents('datas.json', join('', $data));
    }

}
