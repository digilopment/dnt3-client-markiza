<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\BaseController;
use DntLibrary\Base\Dnt;
use DntLibrary\Base\Frontend;

class DefaultController extends BaseController
{

    protected $dnt;
    protected $frontend;

    public function __construct()
    {
        $this->dnt = new Dnt();
        $this->frontend = new Frontend();
    }

    public function run()
    {
        header("HTTP/1.0 404 Not Found");
        $data = $this->frontend->get();
        $this->modulConfigurator($data, $this->modul());
    }

}
