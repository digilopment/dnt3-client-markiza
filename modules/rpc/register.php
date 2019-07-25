<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');


function reArrayFiles(&$file_post) {
	$file_ary = array();
	$file_count = count($file_post['name']);
	$file_keys = @array_keys($file_post);
	for ($i=0; $i<$file_count; $i++) {
		foreach ($file_keys as $key) {
			$file_ary[$i][$key] = $file_post[$key][$i];
		}
	}
	return $file_ary;
}

$rest 				= new Rest;
$db					= new Db;
$dntMailer			= new Mailer;

$postId				= $rest->webhook(4);
$data 				= Frontend::get(false, $postId);
$formName			= $data['article']['name'];
$siteKey 			= $data['meta_settings']['keys']['gc_site_key']['value']; 
$secretKey 			= $data['meta_settings']['keys']['gc_secret_key']['value'];
$gc 				= new GoogleCaptcha($siteKey, $secretKey);


$meno 				= $rest->post("meno");
$priezvisko 		= $rest->post("priezvisko");
$email 				= $rest->post("email");
$tel_c 				= $rest->post("tel_c");
$adresa 			= $rest->post("adresa");
$sprava 			= $rest->post("sprava");
$suhlas 			= $rest->post("suhlas");

if($data['article']['embed']){
	$prijemcovia = array("thomas.doubek@gmail.com", $data['article']['embed']);
}else{
	$prijemcovia = array("thomas.doubek@gmail.com");
}


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
//var_dump($data['meta_settings']['keys']['vendor_email']['value']);
if(!empty($meno) && !empty($priezvisko)){
	if($gc->getResult() || $NO_CAPTCHA){
		$attachment = "";
		
		$myPath = "dnt-view/data/external-uploads/";
		$file_ary = reArrayFiles($_FILES['file']);
		foreach ($file_ary as $file) {
			$dntUpload = new Upload($file); 
			//pracuje s ajaxom VIDEA
			if ($dntUpload->uploaded) {
				$dntUpload->file_new_name_body = Vendor::getId()."_".md5(time())."_o";
			   // save uploaded image with no changes
			   $dntUpload->Process($myPath);
			   if ($dntUpload->processed) {
				 $RESPONSE = 1;
				 $UPLOADED = 1;
				 //$attachment[] =  "<a href='".WWW_PATH.$myPath.$dntUpload->file_dst_name."' >".$dntUpload->file_dst_name."</a>";
				 $attachment[] =  WWW_PATH.$myPath.$dntUpload->file_dst_name."\n";
			   } else {
				 $RESPONSE = 0;
				 $UPLOADED = 0;
			   }
			}
		}
		$prilohy = @implode("<br/>", $attachment);
		
		//EMAIL TEMPLATE		
		$msg = 
			'<html><head></head><body>
			<h3>Kontaktné údaje</h3>
			<b>Formulár:</b>: '.$formName.'<br/>
			<b>Meno</b>: '.$meno.'<br/>
			<b>Priezvisko</b>: '.$priezvisko.'<br/>
			<b>Email</b>: '.$email.'<br/>
			<b>Tel.č</b>: '.$tel_c .'<br/>
			<b>Adresa</b>: '.$adresa.'<br/>
			<b>Správa</b>: '.$sprava.'<br/>
			<b>Prílohy:</b><br/>
			'.$prilohy.'
			</body>
		</html>';
		
		//$msh = "SSS";
		
		
		
		$senderEmail 	= $data['meta_settings']['keys']['vendor_email']['value'];
		
		$dntMailer->set_recipient($prijemcovia);
		$dntMailer->set_msg($msg);
		$dntMailer->set_subject($formName);
		$dntMailer->set_sender_name("Markíza");
		$dntMailer->set_sender_email($senderEmail);
		$dntMailer->sent_email();
		
		//$msg = mysql_real_escape_string($msg);
	
		$table								= "dnt_registred_users";
		
		$insertedData["`type`"] 			= Dnt::name_url($formName)."-".$postId;
		$insertedData["`vendor_id`"] 		= Vendor::getId();
		$insertedData["`datetime_creat`"] 	= Dnt::datetime();
		
		
		$insertedData["`name`"] 			= $meno;
		$insertedData["`surname`"] 			= $priezvisko;
		$insertedData["`content`"] 			= $msg;
		
		$insertedData["`session_id`"] 		= uniqid();
		
		//$insertedData["`psc`"] 				= $form_base_psc;
		$insertedData["`mesto`"] 			= $adresa;
		$insertedData["`email`"] 			= $email;
		$insertedData["`tel_c`"] 			= $tel_c;
		//$insertedData["`custom_1`"] 		= $form_base_custom_1;
		$insertedData["`podmienky`"] 		= 1;
		$insertedData["`status`"] 			= 1;
		
	
		$insertedData["`ip_adresa`"] 	= Dnt::get_ip();
		//$insertedData["`img`"] 			= $prilohy;
		
		$db->dbTransaction();
			$db->insert($table, $insertedData);
			$userId = Dnt::getLastId($table);
		$db->dbcommit();
		
	
		
	
	
		$RESPONSE 		= 1;
		$CUSTOM 		= "done";
		$ATTACHMENT 	= "";
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