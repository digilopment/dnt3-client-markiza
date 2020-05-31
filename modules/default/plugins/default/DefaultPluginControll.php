<?php

namespace DntView\Layout\Modul\Plugin;

use DntLibrary\App\Plugin;
use DntLibrary\Base\Frontend;
use DntLibrary\Base\Settings;
use DntView\Layout\App\MarkizaForm;

class DefaultPluginControll extends Plugin
{

    protected $loc = __FILE__;
    protected $markiza;
    protected $frontend;

    public function __construct()
    {
        $this->markiza = new MarkizaForm();
        $this->frontend = new Frontend();
        $this->settings = new Settings();
    }

    public function run()
    {
        $this->layout($this->loc, $this->modul(), false, false);
    }

}
