<?php
class rpcModulController extends rpcAbstractModulController{
	
	public function run(){
		$rest 		= new Rest;
		$db 		= new Db;
		if($rest->webhook(2) == "json" && $rest->webhook(3) == "competition-register" && $rest->webhook(4)){ //o jeden vyssi webhook ako maximalnz mozny
			include "register.php";
		}else{
			$rest->loadDefault();
		}
	}
	
}

rpcModulController::run();