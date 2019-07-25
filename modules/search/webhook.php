<?php
class searchModulController{
	
	public function run(){
		$rest 		= new Rest;
		$db 		= new Db;

		include "dnt-view/layouts/".Vendor::getLayout()."/modules/article_list/tpl.php";
	}
	
}

searchModulController::run();