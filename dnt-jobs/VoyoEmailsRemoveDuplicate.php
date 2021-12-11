<?php

namespace DntJobs;

use DntLibrary\Base\DB;

class VoyoEmailsRemoveDuplicateJob
{

    const CAT_ID = 91;
    const VENDOR_ID = 39;
    const DELETE_PERIOD = 2;
	
    protected $db;
    protected $dbEmails = [];

    public function __construct()
    {
        $this->db = new DB();
    }

    
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

        $countTotalLogs = count($data);
        $this->dbEmails = $data;
    }
	
    protected function init()
    {
        $this->dbEmails();
    }
	
    public function run()
    {
		$this->init();
		$duplicates = [];
		foreach(array_count_values($this->dbEmails) as $email => $count){
			if($count > 1){
				$query = "DELETE FROM `dnt_mailer_mails` WHERE cat_id = '" . self::CAT_ID . "' AND vendor_id = '" . self::VENDOR_ID . "' AND email = '" . $email . "' ORDER BY id DESC LIMIT " . $count - 1 . "";
				$duplicates[$email] = $query;
			}
		}
		
		$final = [];
		$i = 0;
		
		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		foreach($duplicates as $email => $sql){
			$stmt = mysqli_prepare($link, $sql);
			mysqli_stmt_execute($stmt);
			//echo $email . "<br/>";
			$i++;
		}
		
		echo $i . " - duplicates were deleted";
		
    }

}
