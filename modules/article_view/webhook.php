<?php
class articleViewModulController{
	
	public function run(){
		$article = new ArticleView;
		$rest 		= new Rest;

		$id = $rest->webhook(3);

		$show = AdminContent::getPostParam("show", $id);
		if($show>0){
			$custom_data = array(
				"post_id" => $id,
				"title" =>  $article->getPostParam("name",  $id)." | ".Settings::get("title") ,
				"meta" => array(
					 '<meta name="keywords" content="'.$article->getPostParam("tags",  $id).'" />',
					 '<meta name="description" content="'.$article->getPostParam("name",  $id).'" />',
					 '<meta content="'.$article->getPostParam("name",  $id).'" property="og:title" />',
					 '<meta content="'.SERVER_NAME.'" property="og:site_name" />',
					 '<meta content="article" property="og:type" />',
					 '<meta content="'.$article->getPostImage($id).'" property="og:image" />',
				),
			);
			include "tpl.php";
		}else{
			include "dnt-view/layouts/".Vendor::getLayout()."/modules/default/tpl.php";
		}
	}
}

articleViewModulController::run();