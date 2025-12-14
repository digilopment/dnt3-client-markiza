<?php

namespace DntView\Layout;

use DntLibrary\App\Autoloader;
use DntLibrary\Base\Vendor;
use DntLibrary\Base\Webhook;

class Configurator
{

    protected $webhook;
    
    protected Vendor $vendor;

    public function __construct()
    {
        (new Autoloader)->addVendroClass(__FILE__, 'MarkizaForm');
        $this->webhook = new Webhook();
        $this->vendor = new Vendor();
    }

    public function vendorConfig()
    {
        return [
            'apiKey' => '20Mar15Kiza',
            'voyoService' => 'https://backend.voyo.sk/lbackend/eshop/nl_sync.php',
            'serviceLogin' => 'mklepoch',
            'servicePsswd' => 'martin 650',
            'decryptedKey' => 'Voyo2020MarkizaDevTem',
            'sentMailPerRequest' => 60,
            'unsubscribeDomain' => 'https://odhlasenie.markiza.sk/',
            'rempService' => 'https://crm.cms.markiza.sk/api/v1/user-segments/users?code=newsletters-gdpr-ready',
            'crmService' => 'https://crm.cms.markiza.sk/api/v1/user-segments/users?code=',
            'rempBareerToken' => '496f34c82af4bfc72a663595602757e3',
            'datacruitLogin' => 'web@markiza.sk',
            'datacruitPassword' => 'lq!j73Hkw_kq3B',
        ];
    }

    public function modulesRegistrator()
    {
        // Optimalizované: načítame všetky moduly naraz v jednom SQL dotaze
        $services = array(
            'clean' => 'clean',
            'forms' => 'forms',
            'tvn_app' => 'tvn_app',
            'subscriber' => 'subscriber',
        );
        
        $sitemapModules = $this->webhook->getSitemapModulesBatch($services);
        
        $modulesRegistrator = array(
            'clean' => array_merge(
                    array(), $sitemapModules['clean'] ?? array()
            ),
            'forms' => array_merge(
                    array(), $sitemapModules['forms'] ?? array()
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
                    array(), $sitemapModules['tvn_app'] ?? array()
            ),
            'subscriber' => array_merge(
                    array(), $sitemapModules['subscriber'] ?? array()
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
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '0',
            '`order`' => '150',
        );

        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'smtp_host',
            '`value`' => 'smtp.gmail.com',
            '`content_type`' => 'text',
            '`description`' => 'SMTP Host',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '1',
            '`order`' => '160',
        );
        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'smtp_username',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'SMTP User name (email)',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '1',
            '`order`' => '170',
        );
        $insertedData[] = array(
            '`type`' => 'keys',
            '`key`' => 'smtp_password',
            '`value`' => '',
            '`content_type`' => 'text',
            '`description`' => 'SMTP heslo',
            '`vendor_id`' => $this->vendor->getId(),
            '`show`' => '1',
            '`order`' => '10',
        );

        return $insertedData;
    }

}
