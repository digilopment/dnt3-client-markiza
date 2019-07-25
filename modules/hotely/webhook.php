<?php
class hotelyModulController{
	
	public function run(){
		$rest 		= new Rest;
		$db 		= new Db;
		if($rest->webhook(2)){ //o jeden vyssi webhook ako maximalnz mozny
			$rest->loadDefault();
		}else{
			include "tpl.php";
		}
	}
}

hotelyModulController::run();