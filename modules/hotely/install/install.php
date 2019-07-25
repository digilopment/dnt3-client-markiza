<?php
function defaultModuleMetaDataConfiguration($postId, $service){
	
	$defaultContent	= "Content";
	$pocetHotelov = 10;
	$oredr = 100;
	for($i =1;$i<=$pocetHotelov;$i++){
		
		$oredr = $oredr + 100;
		if($i>1){
			$show = 0;
		}else{
			$show = 1;
		}
		$insertedData[] = array(
			'`post_id`' 		=> $postId, 
			'`service`' 		=> $service, 
			'`vendor_id`' 		=> Vendor::getId(), 
			'`key`' 			=> "id_".$i."_hotel_name", 
			'`value`' 			=> $defaultContent, 
			'`content_type`' 	=> "text",
			'`cat_id`' 			=> "3",
			'`description`' 	=> "(<b>Hotel č. ".$i."</b>) Názov hotelu", 
			'`order`' 			=> $oredr, 
			'`show`' 			=> $show, 
		);
		
		$oredr = $oredr + 100;
		$insertedData[] = array(
			'`post_id`' 		=> $postId, 
			'`service`' 		=> $service, 
			'`vendor_id`' 		=> Vendor::getId(), 
			'`key`' 			=> "id_".$i."_text", 
			'`value`' 			=> $defaultContent, 
			'`content_type`' 	=> "content",
			'`cat_id`' 			=> "3",
			'`description`' 	=> "(<b>Hotel č. ".$i."</b>) Text k hotelu 1", 
			'`order`' 			=> $oredr, 
			'`show`' 			=> $show, 
		);
		
		$oredr = $oredr + 100;
		$insertedData[] = array(
			'`post_id`' 		=> $postId, 
			'`service`' 		=> $service, 
			'`vendor_id`' 		=> Vendor::getId(), 
			'`key`' 			=> "id_".$i."_text_2", 
			'`value`' 			=> $defaultContent, 
			'`content_type`' 	=> "content",
			'`cat_id`' 			=> "3",
			'`description`' 	=> "(<b>Hotel č. ".$i."</b>) Text k hotelu 2", 
			'`order`' 			=> $oredr, 
			'`show`' 			=> $show, 
		);
		
		$oredr = $oredr + 100;
		$insertedData[] = array(
			'`post_id`' 		=> $postId, 
			'`service`' 		=> $service, 
			'`vendor_id`' 		=> Vendor::getId(), 
			'`key`' 			=> "id_".$i."_adresa", 
			'`value`' 			=> $defaultContent, 
			'`content_type`' 	=> "text",
			'`cat_id`' 			=> "3",
			'`description`' 	=> "(<b>Hotel č. ".$i."</b>) Adresa", 
			'`order`' 			=> $oredr, 
			'`show`' 			=> $show, 
		);
		
		$oredr = $oredr + 100;
		$insertedData[] = array(
			'`post_id`' 		=> $postId, 
			'`service`' 		=> $service, 
			'`vendor_id`' 		=> Vendor::getId(), 
			'`key`' 			=> "id_".$i."_tel_c", 
			'`value`' 			=> $defaultContent, 
			'`content_type`' 	=> "text",
			'`cat_id`' 			=> "3",
			'`description`' 	=> "(<b>Hotel č. ".$i."</b>) Telefónne číslo", 
			'`order`' 			=> $oredr, 
			'`show`' 			=> $show, 
		);
		
		$oredr = $oredr + 100;
		$insertedData[] = array(
			'`post_id`' 		=> $postId, 
			'`service`' 		=> $service, 
			'`vendor_id`' 		=> Vendor::getId(), 
			'`key`' 			=> "id_".$i."_email", 
			'`value`' 			=> $defaultContent, 
			'`content_type`' 	=> "text",
			'`cat_id`' 			=> "3",
			'`description`' 	=> "(<b>Hotel č. ".$i."</b>) Email", 
			'`order`' 			=> $oredr, 
			'`show`' 			=> $show, 
		);
		
		$oredr = $oredr + 100;
		$insertedData[] = array(
			'`post_id`' 		=> $postId, 
			'`service`' 		=> $service, 
			'`vendor_id`' 		=> Vendor::getId(), 
			'`key`' 			=> "id_".$i."_web", 
			'`value`' 			=> $defaultContent, 
			'`content_type`' 	=> "text",
			'`cat_id`' 			=> "3",
			'`description`' 	=> "(<b>Hotel č. ".$i."</b>) Webová adresa", 
			'`order`' 			=> $oredr, 
			'`show`' 			=> $show, 
		);
		
		$oredr = $oredr + 100;
		$insertedData[] = array(
			'`post_id`' 		=> $postId, 
			'`service`' 		=> $service, 
			'`vendor_id`' 		=> Vendor::getId(), 
			'`key`' 			=> "id_".$i."_image_1", 
			'`value`' 			=> $defaultContent, 
			'`content_type`' 	=> "image",
			'`cat_id`' 			=> "3",
			'`description`' 	=> "(<b>Hotel č. ".$i."</b>) Fotky", 
			'`order`' 			=> $oredr, 
			'`show`' 			=> $show, 
		);
	}
	return $insertedData;
	
}