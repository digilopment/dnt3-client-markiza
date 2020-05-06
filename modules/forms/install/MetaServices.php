<?php

class MetaServices
{

    protected $content = 'Content';

    public function init($postId, $service)
    {
        $defaultContent = $this->content;
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_base_name",
            '`value`' => 'Vaše meno',
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Input Meno",
            '`order`' => "100",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_base_surname",
            '`value`' => 'Vaše priezvisko',
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Input Priezvisko",
            '`order`' => "200",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_base_email",
            '`value`' => 'E-mailová adresa',
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Input Email",
            '`order`' => "300",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_base_tel_c",
            '`value`' => 'Telefónne číslo',
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Input Tel. číslo",
            '`order`' => "400",
            '`show`' => "1",
        );
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_base_adresa",
            '`value`' => 'Adresa',
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Input Adresa",
            '`order`' => "500",
            '`show`' => "1",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "message",
            '`value`' => "Odkaz pre nás",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Správa pre nás",
            '`order`' => "600",
            '`show`' => "1",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_user_image_1",
            '`value`' => "Prílohy",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Upload súboru",
            '`order`' => "700",
            '`show`' => "1",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "white_list_extensions",
            '`value`' => "image/*,video/*",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Povolené typy súborov",
            '`order`' => "800",
            '`show`' => "0",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "video_link",
            '`value`' => "Prosím vložte odkaz na Vaše videos",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Url link na video",
            '`order`' => "850",
            '`show`' => "0",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_file_podmienky_1",
            '`value`' => "",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Odoslaním formuláru súhlasím s pravidlami súťaže",
            '`order`' => "900",
            '`show`' => "1",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_file_podmienky_2",
            '`value`' => "",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Odoslaním formuláru súhlasím s použitím poskytnutého audiovizuálneho záznamu (súťažného videa)",
            '`order`' => "1000",
            '`show`' => "1",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_file_podmienky_3",
            '`value`' => "",
            '`content_type`' => "text",
            '`cat_id`' => "4",
            '`description`' => "Odoslaním formuláru súhlasím so spracovaním osobitných kategórií osobných údajov",
            '`order`' => "1100",
            '`show`' => "0",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_file_podmienky_4",
            '`value`' => "",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Potvrdzujem, že vo vzťahu k poskytnutému súťažnému videu mám vysporiadané všetky potrebné práva tretích osôb",
            '`order`' => "1200",
            '`show`' => "0",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "form_file_info_1",
            '`value`' => "",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Podmienky a informácie o spracovávaní osobných údajov účastníkov súťaže spol. MARKÍZA - SLOVAKIA, spol. s r.o",
            '`order`' => "1300",
            '`show`' => "1",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "ajax_url",
            '`value`' => "",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Servis (ajax url) na spracovanie dát",
            '`order`' => "1400",
            '`show`' => "1",
        );
        
     
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "content",
            '`value`' => "Toto je content článku s formulárom",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Obsah článku",
            '`order`' => "1500",
            '`show`' => "1",
        );
        
        $insertedData[] = array(
            '`post_id`' => $postId,
            '`service`' => $service,
            '`vendor_id`' => Vendor::getId(),
            '`key`' => "perex",
            '`value`' => "Toto je perex",
            '`content_type`' => "text",
            '`cat_id`' => "3",
            '`description`' => "Perex článku",
            '`order`' => "1600",
            '`show`' => "1",
        );

        return $insertedData;
    }

}
