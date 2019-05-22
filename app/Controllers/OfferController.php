<?php
namespace App\Controllers;

use Slim\Container;

class OfferController extends BaseController
{
    private $OfferService;
    private $OfferTransformer;

    public function __construct(Container $container)
    {
        $this->OfferService = $container->get('OfferService');
        $this->OfferTransformer = $container->get('OfferTransformer');
    }

    public function create($request, $response)
    {
        $offers = $this->OfferService->create($request->getParsedBody());
        $data = $this->toFractalResponse(
            $offers,
            $this->OfferTransformer
        );
        return $response->withJson($data);
    }
}
