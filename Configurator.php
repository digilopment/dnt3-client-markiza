<?php

class Configurator
{

    protected $webhook;

    public function __construct()
    {
        (new Autoloader)->addVendroClass(__FILE__, 'MarkizaForm');
        $this->webhook = new Webhook();
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
