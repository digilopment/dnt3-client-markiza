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

    public function __construct($data, $pluginId)
    {
        parent::__construct($data, $pluginId);
		$this->data = $data;
        $this->markiza = new MarkizaForm();
        $this->frontend = new Frontend();
    }

    public function run()
    {
		$data = $this->data;
        $html = $this->layout($this->loc, 'form', $data, true);
        print $this->markiza->getHybsaTemplate($html);
    }

}
