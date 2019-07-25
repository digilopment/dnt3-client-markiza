<?php
function custom_modules($webhook = false){
	if(!$webhook){
		$webhook = new Webhook;
	}
	/*
	custom modul listeners
	*/
	$custom_modules = array(
		//PARTNERI
		"intro" => array_merge(
				array(), $webhook->getSitemapModules("intro")
		), 
		"region" => array_merge(
				array(), $webhook->getSitemapModules("region")
		), 		
		"hotely" => array_merge(
				array(), $webhook->getSitemapModules("hotely")
		),  
		"partneri" => array_merge(
				array(), $webhook->getSitemapModules("partneri")
		),
		"registracia" => array_merge(
				array(), $webhook->getSitemapModules("registracia")
		),
		"singl_page" => array_merge(
				array(), $webhook->getSitemapModules("singl_page")
		),
		"search" => array_merge(
				array(), $webhook->getSitemapModules("search")
		),
		"clean" => array_merge(
				array(), $webhook->getSitemapModules("clean")
		),
		
		//DETAIL
		"article_view" => array_merge(
			array(), array("{alphabet}/detail/{digit}/{alphabet}")
		),
		//AUTOREDIRECT
		"auto_redirect" => array_merge(
			array(), array("a/{digit}")
		),			
		//VIDEO EMBED
		"video_embed" => array_merge(
			array(), array("embed/video/{digit}")
		),
		//RPC
		"rpc" => array_merge(
			array(), array("rpc/json/{eny}/{eny}")
		),
		
		/*"homepage" => array_merge(
				array(), $webhook->getSitemapModules("homepage")
		),
		"contact" => array_merge(
				array(), $webhook->getSitemapModules("contact")
		),
		"article_list" => array_merge(
				array(), $webhook->getSitemapModules("article_list")
		),
		*/
	);
	return $custom_modules;
}

function modulesConfig(){
	return array(
		"intro" => array(
			"service_name" => "Intro",
			"sql" => ""
		),
		"hotely" => array(
			"service_name" => "Hotely",
			"sql" => ""
		),
		"region" => array(
			"service_name" => "Región",
			"sql" => ""
		),
		"partneri" => array(
			"service_name" => "Partneri",
			"sql" => ""
		),
		"registracia" => array(
			"service_name" => "Registrácia",
			"sql" => ""
		),
		"singl_page" => array(
			"service_name" => "Singl Page",
			"sql" => ""
		),
		"search" => array(
			"service_name" => "Vyhľadávanie",
			"sql" => ""
		),
		"clean" => array(
			"service_name" => "Clean Page",
			"sql" => ""
		),
		/*"homepage" => array(
			"service_name" => "Homepage",
			"sql" => ""
		),
		"contact" => array(
			"service_name" => "Kontakt",
			"sql" => ""
		),
		"article_list" => array(
			"service_name" => "Article List",
			"sql" => ""
		),*/
	);
}
function websettings(){
	$insertedData[] = array(
		'`type`' 			=> "social_wall", 
		'`key`' 			=> "facebook_page_sw", 
		'`value`' 			=> "", 
		'`content_type`' 	=> "text", 
		'`description`' 	=> "Facebook Page Social Wall", 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`show`' 			=> '0',
		'`order`' 			=> '10',
	);
	$insertedData[] = array(
		'`type`' 			=> "social_wall", 
		'`key`' 			=> "facebook_post_sw", 
		'`value`' 			=> "", 
		'`content_type`' 	=> "text", 
		'`description`' 	=> "Facebook Post Social Wall", 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`show`' 			=> '0',
		'`order`' 			=> '10',
	);
	$insertedData[] = array(
		'`type`' 			=> "social_wall", 
		'`key`' 			=> "instagram_sw", 
		'`value`' 			=> "", 
		'`content_type`' 	=> "text", 
		'`description`' 	=> "Instagram Post Social Wall", 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`show`' 			=> '0',
		'`order`' 			=> '10',
	);
	$insertedData[] = array(
		'`type`' 			=> "social_wall", 
		'`key`' 			=> "youtube_sw", 
		'`value`' 			=> "", 
		'`content_type`' 	=> "text", 
		'`description`' 	=> "Youtube Social Wall", 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`show`' 			=> '0',
		'`order`' 			=> '10',
	);
	$insertedData[] = array(
		'`type`' 			=> "social_wall", 
		'`key`' 			=> "twitter_sw", 
		'`value`' 			=> "", 
		'`content_type`' 	=> "text", 
		'`description`' 	=> "Twitter Social Wall", 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`show`' 			=> '0',
		'`order`' 			=> '10',
	);
	$insertedData[] = array(
		'`type`' 			=> "keys", 
		'`key`' 			=> "send_grid_api_key", 
		'`value`' 			=> "", 
		'`content_type`' 	=> "text", 
		'`description`' 	=> "Api key pre Send grid", 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`show`' 			=> '0',
		'`order`' 			=> '10',
	);
	$insertedData[] = array(
		'`type`' 			=> "keys", 
		'`key`' 			=> "send_grid_api_template_id", 
		'`value`' 			=> "", 
		'`content_type`' 	=> "text", 
		'`description`' 	=> "Template ID pre Send grid", 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`show`' 			=> '0',
		'`order`' 			=> '10',
	);
	$insertedData[] = array(
		'`type`' 			=> "keys", 
		'`key`' 			=> "automatic_voucher", 
		'`value`' 			=> "", 
		'`content_type`' 	=> "text", 
		'`description`' 	=> "Automatické odosielanie voucherov", 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`show`' 			=> '0',
		'`order`' 			=> '10',
	);
	
	return $insertedData;
}