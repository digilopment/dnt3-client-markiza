<?php
class cleanModulController{
	
	public function run(){
		include "tpl.php";
	}
}

$modul = new cleanModulController();
$modul->run();