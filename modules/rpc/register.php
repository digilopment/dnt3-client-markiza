<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$rest 				= new Rest;
$db					= new Db;
$dntMailer			= new Mailer;

$postId				= $rest->webhook(4);
$data 				= Frontend::get(false, $postId);
$siteKey 			= $data['meta_settings']['keys']['gc_site_key']['value']; 
$secretKey 			= $data['meta_settings']['keys']['gc_secret_key']['value'];
$gc 				= new GoogleCaptcha($siteKey, $secretKey);


$meno 				= $rest->post("meno");
$priezvisko 		= $rest->post("priezvisko");
$email 				= $rest->post("email");
$adresa 			= $rest->post("tel_c");
$meno 				= $rest->post("adresa");
$sprava 			= $rest->post("sprava");
$suhlas 			= $rest->post("suhlas");


$prijemcovia = array("thomas.doubek@gmail.com");

if($data['meta_settings']['keys']['gc_secret_key']['show'] == 1 && $data['meta_settings']['keys']['gc_site_key']['show'] == 1){
	$NO_CAPTCHA = 0;
	if(isset($_POST['g-recaptcha-response'])){
		$gcResponse = $_POST['g-recaptcha-response'];
	}else{
		$gcResponse = false;
	}
	$gc->setCheckedOptions($gcResponse);
}else{
	$NO_CAPTCHA = 1;
}

if(isset($_POST['odoslat'])){
	if($gc->getResult() || $NO_CAPTCHA){
		$attachment = "";
		
		$filePath = "dnt-view/data/external-uploads/";
		if(isset($_FILES['file']) ){  
			$dntUpload = new Upload($_FILES['file']); 
			if ($dntUpload->uploaded) {
			   // save uploaded image with no changes
			   $dntUpload->image_resize = true;
			   $dntUpload->image_convert = 'jpg';
			   $dntUpload->image_x = 800;
			   //$dntUpload->image_max_width = 800;   
			   $dntUpload->image_ratio_y = true;
			   $dntUpload->Process($filePath);
			   if ($dntUpload->processed) {
				 $CUSTOM = json_encode(var_export($_FILES['file'], true));
				 $attachment =  "".WWW_PATH."".$filePath."".$dntUpload->file_dst_name."";
			   } else {
				 $attachment = "";
			   }
			}
		}
		
		
		//EMAIL TEMPLATE		
		$msg = 
			'<html><head></head><body>
			
			<h3>Kontaktné údaje</h3>
			<b>Formulár:</b>: '.$THIS_NAZOV.'<br/>
			<b>Meno</b>: '.$meno.'<br/>
			<b>Priezvisko</b>: '.$priezvisko.'<br/>
			<b>Email</b>: '.$email.'<br/>
			<b>Tel.č</b>: '.$tel_c .'<br/>
			<b>Adresa</b>: '.$adresa.'<br/>
			<b>Správa</b>: '.$sprava.'<br/>
			<br/>
			'.$attachment.'
			</body>
		</html>';
	
		$table								= "dnt_stihacka_user";
		
		$insertedData["`type`"] 			= "competitor-user-".$postId;
		$insertedData["`vendor_id`"] 		= Vendor::getId();
		$insertedData["`datetime_creat`"] 	= Dnt::datetime();
		
		
		$insertedData["`name`"] 			= $meno;
		$insertedData["`surname`"] 			= $priezvisko;
		
		$insertedData["`session_id`"] 		= uniqid();
		
		//$insertedData["`psc`"] 				= $form_base_psc;
		$insertedData["`mesto`"] 			= $adresa;
		$insertedData["`email`"] 			= $email;
		$insertedData["`tel_c`"] 			= $tel_c;
		//$insertedData["`custom_1`"] 		= $form_base_custom_1;
		$insertedData["`podmienky`"] 		= 1;
		$insertedData["`status`"] 			= 1;
		
		
		$insertedData["`content`"] 		= $ans;
		$insertedData["`ip_adresa`"] 	= Dnt::get_ip();
		$insertedData["`img`"] 			= $attachment;
		
		$db->dbTransaction();
			$db->insert($table, $insertedData);
			$userId = Dnt::getLastId($table);
		$db->dbcommit();
		
	
		
		$senderEmail 	= $data['meta_tree']['keys']['email_sender']['value'];
		$messageTitle 	= "Ďakujeme za email";
			
		$dntMailer->set_recipient(array($prijemcovia));
		$dntMailer->set_msg($msg);
		$dntMailer->set_subject($messageTitle);
		$dntMailer->set_sender_name($senderEmail);
		$dntMailer->set_sender_email($senderEmail);
		$dntMailer->sent_email();
	
	
		$RESPONSE 		= 1;
		$CUSTOM 		= "done";
		$ATTACHMENT 	= $attachment;
		//$CUSTOM = "done";
	}else{
		$RESPONSE 	= 2;
		$CUSTOM 	= "no captcha";
		$ATTACHMENT = false;
	}
}else{
	$RESPONSE 	= 0;
	$CUSTOM 	= "no post";
	$ATTACHMENT = false;
}

echo '
    {
      "success": "'.$RESPONSE.'",
      "request": "POST",
      "response": "'.$RESPONSE.'",
      "custom": "'.$ATTACHMENT.'",
      "imagex": "",
      "protokol": "REST",
      "lang": "",
      "generator": "Designdnt 3",
      "service": "c_dnt-ajax-universal",
      "message": "Silence is golden, speech is gift :)"
    }';