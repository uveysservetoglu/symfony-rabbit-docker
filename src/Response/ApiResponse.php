<?php
namespace App\Response;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse
{

    private $container;

    /**
     * ApiResponse constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {

        $this->container = $container;
    }

    /**
     * @param array $data
     * @param null $messages
     * @param null $pagination
     * @param int $code
     * @return JsonResponse
     *
     */
    public function responseJson($data = [],  $messages = null, $pagination = null,  $code = 200){

        $response = [
            'code' => $code,
            'message' => $messages,
            'result'=> array(
                'set'=>  $data,
            )
        ];


        if (!is_null($pagination) )
            $response["result"]["pagination"] =  $pagination;

        return new JsonResponse($response, $code);
    }

    /**@todo View response devam edilebilir.*/
}
