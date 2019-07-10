<?php

namespace App\Controller;



class DefaultController extends BaseController
{

    public function index()
    {
        return $this->render(
            'index.html.twig'
        );
    }
}
