<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\Frontend;
use DntView\Layout\App\MarkizaForm;

class FormPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $markiza;
    protected $frontend;

    public function __construct()
    {
        $this->markiza = new MarkizaForm();
        $this->frontend = new Frontend();
    }

    public function run()
    {
        $html = $this->layout($this->loc, 'form', false, true);
        print $this->markiza->getHybsaTemplate($html);
    }

}
