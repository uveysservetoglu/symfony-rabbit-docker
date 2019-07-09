<?php
/**
 * Created by PhpStorm.
 * User: Üveys
 * Date: 9.07.2019
 * Time: 20:44
 */

namespace App\Services;


use App\Object\TranslatableText;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class Translate
{
    private $container;

    public function __construct(Kernel $kernel)
    {
        $this->container = $kernel->getContainer();
    }

    public function translate($text, $textLang ='tr', $tLang = ['en'])
    {
        $param = $this->container->getParameter('yandex_translate');

        $client = new  Client();

        $translateTextAndLang = array();

        $translateTextAndLang[$textLang] = $text;

        foreach ($tLang as $value){
            $lang = $textLang.'-'.$value;
            $res = $client->post($param["url"].'?key='.$param["api_key"].'&lang='.$lang.'&text='.$text);
            $content = json_decode($res->getBody()->getContents());

            $translateTextAndLang[$value] = $content->text[0];
        }

        $translatable = new TranslatableText($translateTextAndLang);



        $serializer =  (new SerializerBuilder())->create()->build();
        $jsonContent = $serializer->serialize($translatable, 'json');

        return $jsonContent;
    }
}