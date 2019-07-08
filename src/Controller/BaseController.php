<?php

namespace App\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class BaseController extends FOSRestController
{
    /**
     * @param $valid
     * @param $data
     *
     * @return array
     */
    public function validation($valid, $data){

        $notKey = array();
        foreach ($valid as $key){
            if(!property_exists($data, $key)){
                $notKey[] = $key;
            }
        }
        return $notKey;
    }

}
