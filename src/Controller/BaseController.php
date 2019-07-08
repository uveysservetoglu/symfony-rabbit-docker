<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends AbstractController
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
