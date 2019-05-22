<?php
namespace App\Controllers;

use Slim\Container;

class RecipientController extends BaseController
{
    private $recipientService;
    private $recipientTransformer;
    private $recipientRequestValidator;
    private $recipientVouchersTransformer;

    public function __construct(Container $container)
    {
        $this->recipientService = $container->get('RecipientService');
        $this->recipientTransformer = $container->get('RecipientTransformer');
        $this->recipientRequestValidator = $container->get('RecipientRequestValidator');
        $this->recipientVouchersTransformer = $container->get('RecipientVouchersTransformer');
    }

    public function getList($request, $response)
    {
        $recipients = $this->recipientService->getAll();
        $data = $this->toFractalResponse(
            $recipients,
            $this->recipientTransformer
        );
        return $response->withJson($data);
    }

    public function getVouchers($request, $response)
    {
        $requestParams = $request->getQueryParams();
        $this->recipientRequestValidator->validate($requestParams);
        $vouchers = $this->recipientService->getVouchers($requestParams['email']);
        $data = $this->toFractalResponse(
            $vouchers,
            $this->recipientVouchersTransformer
        );
        return $response->withJson($data);

    }
}
