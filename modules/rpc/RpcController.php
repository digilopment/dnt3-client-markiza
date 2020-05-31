<?php

namespace DntView\Layout\Modul;

use DntLibrary\App\Autoloader;
use DntLibrary\App\BaseController;
use DntLibrary\Base\DB;
use DntLibrary\Base\Rest;

class RpcController extends BaseController
{

    protected $db;
    protected $rest;
    protected $autoloader;
    protected $path = __FILE__;

    public function __construct()
    {
        $this->rest = new Rest();
        $this->db = new DB();
        $this->autoloader = new Autoloader();
    }

    public function run()
    {
        if ($this->rest->webhook(2) == "json" && $this->rest->webhook(3) == "competition-register" && $this->rest->webhook(4)) {
            $this->autoloader
                    ->addClass($this->path, 'CompetitionRegister', 'init')
                    ->run();
        } else {
            $this->rest->loadDefault();
        }
    }

}
