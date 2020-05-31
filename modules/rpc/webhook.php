<?php

use DntLibrary\Base\DB;
use DntLibrary\Base\Rest;

class rpcModulController
{

    public function run()
    {
        $rest = new Rest;
        $db = new DB;
        if ($rest->webhook(2) == "json" && $rest->webhook(3) == "competition-register" && $rest->webhook(4)) { //o jeden vyssi webhook ako maximalnz mozny
            include "register.php";
        } else {
            $rest->loadDefault();
        }
    }

}

rpcModulController::run();
