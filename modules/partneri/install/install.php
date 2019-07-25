<?php
function defaultModuleMetaDataConfiguration($postId, $service){
	
	$defaultContent	= "Content";
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "id_1_hotel_name", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Názov partnera", 
		'`order`' 			=> "100", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "id_1_text", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "content",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Hlavný text o partnerovi", 
		'`order`' 			=> "200", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "id_1_text_2", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "content",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Text o partnerovi 2", 
		'`order`' 			=> "300", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "id_1_adresa", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Adresa", 
		'`order`' 			=> "400", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "id_1_tel_c", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Telefónne číslo", 
		'`order`' 			=> "500", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "id_1_email", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Email", 
		'`order`' 			=> "600", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "id_1_web", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "text",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Web", 
		'`order`' 			=> "700", 
		'`show`' 			=> "1", 
	);
	$insertedData[] = array(
		'`post_id`' 		=> $postId, 
		'`service`' 		=> $service, 
		'`vendor_id`' 		=> Vendor::getId(), 
		'`key`' 			=> "id_1_image_1", 
		'`value`' 			=> $defaultContent, 
		'`content_type`' 	=> "image",
		'`cat_id`' 			=> "2",
		'`description`' 	=> "Fotka, alebo fotky - max 2", 
		'`order`' 			=> "800", 
		'`show`' 			=> "1", 
	);
	
	return $insertedData;
	
}