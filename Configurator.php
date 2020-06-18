<?php

namespace DntView\Layout;

use DntLibrary\App\Autoloader;
use DntLibrary\Base\Vendor;
use DntLibrary\Base\Webhook;

class Configurator
{

    protected $webhook;

    public function __construct()
    {
        (new Autoloader)->addVendroClass(__FILE__, 'MarkizaForm');
        $this->webhook = new Webhook();
    }

    public function vendorConfig()
    {
        return [
            'apiKey' => '20Mar15Kiza',
            'voyoService' => 'https://backend.voyo.sk/lbackend/eshop/nl_sync.php',
            'serviceLogin' => 'mklepoch',
            'servicePsswd' => 'martin 650',
            'decryptedKey' => 'Voyo2020MarkizaDevTem',
            'sentMailPerRequest' => 50,
            'unsubscribeDomain' => 'https://odhlasenie.markiza.sk/',
        ];
    }

    public function modulesRegistrator()
    {
        $modulesRegistrator = array(
            'clean' => array_merge(
                    array(), $this->webhook->getSitemapModules('clean')
            ),
            'forms' => array_merge(
                    array(), $this->webhook->getSitemapModules('forms')
            ),
            //DETAIL
            'article_view' => array_merge(
                    array(), array('{alphabet}/detail/{digit}/{alphabet}')
            ),
            'default' => array_merge(
                    array(), array('404')
            ),
            //AUTOREDIRECT
            'auto_redirect' => array_merge(
                    array(), array('a/{digit}')
            ),
            //VIDEO EMBED
            'video_embed' => array_merge(
                    array(), array('embed/video/{digit}')
            ),
            //RPC
            'rpc' => array_merge(
                    array(), array('rpc/json/{eny}/{eny}')
            ),
            //TVN APP
            'tvn_app' => array_merge(
                    array(), $this->webhook->getSitemapModules('tvn_app')
            ),
            'subscriber' => array_merge(
                    array(), $this->webhook->getSitemapModules('subscriber')
            ),
        );
        return $modulesRegistrator;
    }

    public function modulesConfigurator()
    {
        return array(
            'clean' => array(
                'service_name' => 'Clean Page',
                'sql' => ''
            ),
            'forms' => array(
                'service_name' => 'Súťažné formuláre',
                'sql' => ''
            ),
            'tvn_app' => array(
                'service_name' => 'Tvn App',
                'sql' => ''
            ),
            'subscriber' => array(
                'service_name' => 'Služba na prihlasenie a odhlasenie z email listingu',
            ),
        );
    }

    public function metaSettings()
    {
        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'automatic_voucher',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'Automatické odosielanie voucherov',
            '`vendor_id`' => Vendor::getId(),
            '`show`' => '0',
            '`order`' => '10',
        );

        return $insertedData;
    }

}
