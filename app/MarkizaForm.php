<?php

namespace DntView\Layout\App;

class MarkizaForm
{

    private $htmlContent;

    public function __construct()
    {
        $this->init();
    }

    /**
     * INIT FUNCTION
     */
    public function init()
    {
        $this->getHTMLContent();
    }

    protected function getHTMLContent()
    {
        $microsite = "http://odzaciatkuvdobrychrukach.mpopovic.beta.markiza.sk/formular/1910907_formular";
        $microsite = "http://telerano.markiza.sk/aktualne/1910793_preco-z-najvacsieho-vitaza-vypadla-barbora";
        $microsite = "http://oteckovia.markiza.sk/aktualne/1910586_milenci-pristihnuti-toto-je-podpasovka-nielen-pre-luciu";
        $microsite = "http://hybsa.markiza.sk/aktualne/1910931_televizia-markiza-coskoro-rozhybe-cele-rodiny-blizia-sa-sportove-hry-hybsadays";
        $microsite = "http://oteckovia.markiza.sk/aktualne/1933892_ustrachanemu-veterinarovi-je-koniec-tomasovi-uplne-preplo";
        //$microsite = "http://nadacia.markiza.sk/aktualne/1910740_pribeh-lacka-zo-superstar-dojal-cele-slovensko-pomoct-mu-mozete-aj-vy";
        $microsite = "http://telerano.markiza.sk/aktualne/1910793_preco-z-najvacsieho-vitaza-vypadla-barbora";

        if ($this->htmlContent) {
            return $this->htmlContent;
        }
        $this->htmlContent = file_get_contents($microsite);
        return $this->htmlContent;
    }

    protected function get_top()
    {
        $template = explode('<div class="col-xs-12 col-sm-12 col-md-8 content_box">', $this->htmlContent);

        $template = $template[0];
        $template = str_replace('<body>', '<body onload="">', $template);
        $template = str_replace('/media/3.0/mar/grf/top', 'http://www.markiza.sk/media/3.0/mar/grf/top', $template);
        //$template = str_replace('<script src="http://imagesrv.adition.com/js/adition.js" type="text/javascript"></script>', '', $template);
        $template = str_replace('<form action="/vyhladavanie" class="search">', '<form action="http://www.markiza.sk/vyhladavanie" class="search">', $template);
        $template = str_replace('/media/3.0/core/bootstrap3/css/font-awesome.min.css', 'http://www.markiza.sk/media/3.0/core/bootstrap3/css/font-awesome.min.css', $template);
        $template = str_replace('/media/3.0/mar/css/microsite', "http://www.markiza.sk/media/3.0/mar/css/microsite", $template);
        $template = str_replace('/media/3.0/mar/microsites/', "http://www.markiza.sk/media/3.0/mar/microsites/", $template);

        $return = $template;
        //$return .= "/>"; //dokoncenie divka
        $return .= '<section class="col-md-8 article-view">'; //dokoncenie divka
        return $return;
    }

    protected function get_bottom($rightColumn)
    {
        $return = "</section>"; //end col 8
        $return .= $rightColumn; //end col 8
        //$return .= rightColumn();
        $return .= "</div>"; //end row 
        $return .= "</div>"; //end row 

        $template = explode('class="tvn-footer"', $this->htmlContent);
        $return .= '<footer class="tvn-footer"'; //yaciatok footra
        $template = $template[1];
        $template = str_replace('/media/3.0/', "http://www.markiza.sk/media/3.0/", $template);
        $template = str_replace('/media/3.0/mar/css/microsite', "http://www.markiza.sk/media/3.0/mar/css/microsite", $template);
        $template = str_replace('/media/3.0/mar/microsites/', "http://www.markiza.sk/media/3.0/mar/microsites/", $template);
        $return .= $template;
        return $return;
    }

    protected function get_right_column()
    {
        $template = explode('<div class="col-xs-12 col-sm-12 col-md-4 right_box">', $this->htmlContent);

        $template = $template[1];
        $template = str_replace('<body>', '<body onload="">', $template);
        $template = str_replace('/media/3.0/mar/grf/top', 'http://www.markiza.sk/media/3.0/mar/grf/top', $template);
        $template = str_replace('<form action="/vyhladavanie" class="search">', '<form action="http://www.markiza.sk/vyhladavanie" class="search">', $template);
        $template = str_replace('/media/3.0/core/bootstrap3/css/font-awesome.min.css', 'http://www.markiza.sk/media/3.0/core/bootstrap3/css/font-awesome.min.css', $template);

        $return = '<section class="col-md-4 right-column">'; //dokoncenie divka
        $return .= $template;

        $return .= $template;
        $return = explode('<div class="col-xs-12 fullpage_wrap suggestion_cont row">', $return);
        $return = $return[0];
        return '' . $return . '';
    }

    protected function getCss()
    {
        return false;
        return '<link href="./css/inc.css?v' . time() . '" media="screen, tv, projection" rel="stylesheet" type="text/css" />';
    }

    public function getHybsaTemplate($content)
    {
        $data = false;
        $data .= $this->get_top();
        $data .= $this->getCss();
        $data .= $content;
        $data .= $this->get_bottom($this->get_right_column());
        return $data;
    }

}
