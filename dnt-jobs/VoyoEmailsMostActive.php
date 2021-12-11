<?php

namespace DntJobs;

use DntLibrary\Base\DB;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Vendor;
use DntLibrary\Base\Dnt;
use mysqli;

class VoyoEmailsMostActiveJob
{

    const UNACTIVE_PERIOD = 20; //DAYS

    protected $emailCatId = 91;
    protected $db;
    protected $dnt;
    protected $vendor;
    protected $countEmails = 0;
    protected $logs = [];
    protected $emails = [];
    protected $dates = [];
    protected $activeEmails = [];
    protected $unactiveEmails = [];

    public function __construct()
    {
		$this->vendor = new Vendor();
    }

    protected function init()
    {
        $this->getLogs();
        $this->emailsInLogs();
        $this->getActiveEmails();
        $this->getActiveClicked();
    }

    protected function getLogs()
    {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = "SELECT msg FROM `dnt_logs` WHERE msg NOT LIKE '%odhlasenie%' AND msg LIKE '%voyo-newsletter-%' AND `timestamp` >= '2021/11/10' order by id ASC";

        $data = [];
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $msg);
            while (mysqli_stmt_fetch($stmt)) {
                $data[] = $msg;
            }
            mysqli_stmt_close($stmt);
        } else {
            print('no datass');
        }

        $countTotalLogs = count($data);
        $this->countLogs = $countTotalLogs;
        $this->logs = $data;
    }
	
	protected function getActiveEmails()
    {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = "SELECT email, datetime_creat FROM `dnt_mailer_mails` WHERE `vendor_id` = '" . $this->vendor->getId() . "'  AND  cat_id = '" . $this->emailCatId . "' AND `show` = 1 AND (
		email LIKE '%gmail.com%' || 
		email LIKE '%azet.sk%' || 
		email LIKE '%centrum.sk%' || 
		email LIKE '%seznam.cz%' || 
		email LIKE '%icloud.com%' || 
		email LIKE '%zoznam.sk%' ||
		email LIKE '%yahoo.com%' ||
		email LIKE '%hotmail.com%' ||
		email LIKE '%email.cz%' ||
		email LIKE '%post.sk%' ||
		email LIKE '%pobox.sk%' ||
		email LIKE '%markiza.sk%' ||
		email LIKE '%atlas.sk%')"; 
		
		$query = "SELECT email, datetime_creat FROM `dnt_mailer_mails` WHERE `vendor_id` = '" . $this->vendor->getId() . "'  AND  cat_id = '" . $this->emailCatId . "' AND `show` = 1 AND datetime_creat >= '2021/11/10'";

        $data = [];
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $email, $date);
            while (mysqli_stmt_fetch($stmt)) {
                $data[] = ['email' => $email, 'date' => $date];
            }
            mysqli_stmt_close($stmt);
        } else {
            print('no data');
        }

        $total = count($data);
        $this->countEmails = $total;
        
		$emails = [];
		$emails = [];
		foreach($data as $k => $v){
			$emails[$v['email']] = $v['email'];
			$dates[$v['email']] = $v['date'];
		}
		//var_dump($emails);
		//exit;
		$this->emails = $emails;
        $this->dates = $dates;
		
    }
	
	protected function emailsInLogs()
    {
        $emails = [];
		$clicked = [];
		$seen = [];
		$campains = [];
        foreach ($this->logs as $log) {
            
			$json = json_decode($log);
			$email = isset($json->email) ? $json->email : false;
			$systemStatus = isset($json->systemStatus) ? $json->systemStatus : false;
			$campainId = isset($json->campainId) ? $json->campainId : false;
			
			//$email = isset(json_decode($log)->email) ? json_decode($log)->email : false;
            //$systemStatus = isset(json_decode($log)->systemStatus) ? json_decode($log)->systemStatus : false;
            //$campainId = isset(json_decode($log)->campainId) ? json_decode($log)->campainId : false;
			
			$campainIdDate = str_replace('voyo-newsletter-', '', $campainId);
			$campainIdDate = str_replace('-part-2', '', $campainIdDate);
			$campainIdDate = str_replace('-part-1', '', $campainIdDate);
			
			if($systemStatus == 'newsletter_log_click'){
				$clicked[] = $email;
			}
			if($systemStatus == 'newsletter_log_seen'){
				$seen[] = $email;
			}
			$campains[$email] = $campainIdDate;
            //$emails[] = ['email' => $email, 'systemStatus' => $systemStatus];
        }
        $this->emailsInLogs = ['clicked' => $clicked, 'seen' => $seen, 'lastCampain' => $campains];
    }
	
	protected function checkEmail($email)
	{
		$i = 0;
		foreach($this->logs as $log){
			$fromLogEmail = isset(json_decode($log)->email) ? json_decode($log)->email : false;
			if($email == $fromLogEmail){
				$i++;
			}
		}
		return $i;
	}
	
	
	protected function getActiveClicked()
	{
		$clicked = [];
		$seen2 = [];
		foreach($this->emailsInLogs['clicked'] as $email){
			$clicked[] = $email;
		}
		
		/*foreach($this->emailsInLogs['seen'] as $email){
			$seen2[] = $email;
		}*/
		$countClick = array_count_values($clicked);
		
		
		
		
		$final = [];
		foreach(array_count_values($this->emailsInLogs['seen']) as $email => $count){
			if(in_array($email, $this->emails)){
				$final[] = ['email' => $email, 'countSeen' => $count, 'countClick' => $countClick[$email]];
			}
		}
		
		$this->finalEmails = $final;
	}

	protected function csv(){
		var_dump('OK');
		$data = '';
		foreach($this->finalEmails as $email){
			$data .=  ''.$email['email'].';'.$email['countClick'].';'.$email['countSeen'].';'.$this->dates[$email['email']].';'.$this->emailsInLogs['lastCampain'][$email['email']].'' . PHP_EOL;
		}
		$data .=  '';
		file_put_contents('data/30days.csv', $data);
	}
	protected function render(){
		
		$data = '<table>';
		foreach($this->finalEmails as $email){
					$data .= '<tr>';
			$data .=  '<td>'.$email['email'].'</td><td>'.$email['countClick'].'</td><td>'.$email['countSeen'].'</td><td>'.$this->dates[$email['email']].'</td><td>'.$this->emailsInLogs['lastCampain'][$email['email']].'</td>';
					$data .=  '</tr>';
		}
		$data .=  '</table>';
		
		
		
		//print($data);
		file_put_contents('data/180days.html', $data);
	}

    public function run()
    {
		$this->init();
		$this->csv();
    }

}
