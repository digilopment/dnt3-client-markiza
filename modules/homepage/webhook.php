<?php
class homepageModulController{
	
	public function run(){
		$rest 		= new Rest;
		$db 		= new Db;
		include "tpl.php";
	}
}

homepageModulController::run();