<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\Render;
use DntLibrary\Base\DB;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\GoogleCaptcha;
use DntLibrary\Base\Mailer;
use DntLibrary\Base\Rest;
use DntLibrary\Base\Upload;
use DntLibrary\Base\Vendor;

class CompetitionRegister
{

    const TABLE = 'dnt_registred_users';
    const UPLOAD_PATH = 'dnt-view/data/external-uploads/';
    const FILE_SOURCE = 'file';

    protected $db;
    protected $rest;
    protected $dntMailer;
    protected $postId;
    protected $data;
    protected $response;

    public function __construct()
    {
        $this->vendor = new Vendor();
        $this->dnt = new Dnt();
        $this->frontend = new Frontend();
        $this->rest = new Rest();
        $this->db = new DB();
        $this->dntMailer = new Mailer();
    }

    protected function reArrayFiles(&$file_post)
    {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = @array_keys($file_post);
        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }

    protected function headers()
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
    }

    protected function init()
    {
        $this->postId = $this->rest->webhook(4);
        $this->data = $this->frontend->get(false, $this->postId);
    }

    protected function noCaptcha()
    {
        if ($this->data['meta_settings']['keys']['gc_secret_key']['show'] == 1 && $this->data['meta_settings']['keys']['gc_site_key']['show'] == 1) {
            return false;
        } else {
            return true;
        }
    }

    protected function validCaptcha()
    {
        $siteKey = $this->data['meta_settings']['keys']['gc_site_key']['value'];
        $secretKey = $this->data['meta_settings']['keys']['gc_secret_key']['value'];
        $gc = new GoogleCaptcha($siteKey, $secretKey);

        if (isset($_POST['g-recaptcha-response'])) {
            $gcResponse = $_POST['g-recaptcha-response'];
            $gc->setCheckedOptions($gcResponse);
            if ($gc->getResult() || $this->noCaptcha()) {
                return true;
            }
        } elseif ($this->noCaptcha()) {
            return true;
        }
        return false;
    }

    protected function treatFormData()
    {
        $rest = $this->rest;
        $db = $this->db;
        $dntMailer = $this->dntMailer;

        $form_base_name = $rest->post("form_base_name") ? $rest->post("form_base_name") : $rest->post("meno");
        $form_base_surname = $rest->post("form_base_surname") ? $rest->post("form_base_name") : $rest->post("priezvisko");
        $form_base_adresa = $rest->post("form_base_adresa") ? $rest->post("form_base_adresa") : $rest->post("adresa");
        $form_base_email = $rest->post("form_base_email") ? $rest->post("form_base_email") : $rest->post("email");
        $form_base_tel_c = $rest->post("form_base_tel_c") ? $rest->post("form_base_tel_c") : $rest->post("tel_c");
        $text = $rest->post("form_message") ? $rest->post("form_message") : $rest->post("sprava");

        $podmienky1 = $rest->post("podmienky1");
        $podmienky2 = $rest->post("podmienky2");

        if (!isset($_POST['sent'])) {
            $this->response = 0;
            $this->status = "no post";
        } elseif (!$this->validCaptcha()) {
            $this->response = 2;
            $this->status = "no captcha";
        } else {
            $this->response = 10;
            $this->status = 'done';

            $attachment = [];
            $prilohy = false;
            $attachment0 = false;
            if (isset($_FILES[self::FILE_SOURCE])) {
                foreach ($this->reArrayFiles($_FILES[self::FILE_SOURCE]) as $file) {
                    $dntUpload = new Upload($file);
                    if ($dntUpload->uploaded) {
                        $dntUpload->Process(self::UPLOAD_PATH);
                        if ($dntUpload->processed) {
                            $attachment[] = WWW_PATH . self::UPLOAD_PATH . $dntUpload->file_dst_name . "\n";
                            $attachment0 = $attachment[0];
                        }
                    }
                }
                $prilohy = implode("<br/>", $attachment);
            }

            $content = '<html><head></head><body>
			<h3>Kontaktné údaje</h3>
			<b>Formulár:</b>: ' . $this->data['article']['name'] . '<br/>
			<b>Meno</b>: ' . $form_base_name . '<br/>
			<b>Priezvisko</b>: ' . $form_base_surname . '<br/>
			<b>Email</b>: ' . $form_base_email . '<br/>
			<b>Tel.č</b>: ' . $form_base_tel_c . '<br/>
			<b>Adresa</b>: ' . $form_base_adresa . '<br/>
			<b>Správa</b>: ' . $text . '<br/>
			<b>Prílohy:</b>
			' . $prilohy . '
			</body>
                    </html>';

            $insertedData["`type`"] = "competitor-user";
            $insertedData["`vendor_id`"] = $this->vendor->getId();
            $insertedData["`datetime_creat`"] = $this->dnt->datetime();
            $insertedData["`name`"] = $form_base_name;
            $insertedData["`surname`"] = $form_base_surname;
            $insertedData["`session_id`"] = uniqid();
            $insertedData["`content`"] = $content;
            $insertedData["`email`"] = $form_base_email;
            $insertedData["`tel_c`"] = $form_base_tel_c;
            $insertedData["`ulica`"] = $form_base_adresa;
            $insertedData["`podmienky`"] = ($podmienky1 && $podmienky2) ? 1 : 0;
            $insertedData["`ip_adresa`"] = $this->dnt->get_ip();
            $insertedData["`img`"] = $attachment0;
            $insertedData["`status`"] = 1;

            $db->dbTransaction();
            $db->insert(self::TABLE, $insertedData);
            $db->dbcommit();

            $senderEmail = "no-reply@markiza.sk";
            $senderName = "Markíza";
            $messageTitle = $this->data['article']['name'];

            $dntMailer->set_recipient(array($form_base_email));
            $dntMailer->set_msg($content);
            $dntMailer->set_subject($messageTitle);
            $dntMailer->set_sender_name($senderName);
            $dntMailer->set_sender_email($senderEmail);
            $dntMailer->sent_email();
        }
    }

    protected function renderData($array)
    {
        return new Render(json_encode($array));
    }

    protected function response()
    {
        return [
            'success' => $this->response,
            'response' => $this->response,
            'imagex' => $this->status
        ];
    }

    public function run()
    {
        $this->init();
        $this->headers();
        $this->treatFormData();
        $this->renderData($this->response())->render();
    }

}
