<?php
/**
 * Created by PhpStorm.
 * User: Üveys
 * Date: 9.07.2019
 * Time: 20:44
 */

namespace App\Services;


use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\HttpKernel\Log\Logger;

class Translate
{
    private $container;
    private $logger;

    public function __construct(Kernel $kernel, Logger $logger)
    {
        $this->container = $kernel->getContainer();
        $this->logger = $logger;

    }

    public function translate($text, $lang ='tr-en')
    {
        $param = $this->container->getParameter('yandex_translate');


    }
}