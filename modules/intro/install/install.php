<?php
function defaultModuleMetaDataConfiguration($postId, $service){
	
	$defaultContent	= "Content";
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "intro_name", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Názov", 
		'`order`' 			=> "100", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "intro_perex", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Perex", 
		'`order`' 			=> "200", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "intro_content", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Content", 
		'`order`' 			=> "300", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "intro_image", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "image",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Fotka", 
		'`order`' 			=> "400", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "intro_bg_image", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "image",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Background Fotka", 
		'`order`' 			=> "500", 
		'`show`' 			=> "1", 
	);
	
	return $insertedData;
	
}