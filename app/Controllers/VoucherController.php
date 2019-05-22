<?php
namespace App\Controllers;

use Slim\Container;

class VoucherController extends BaseController
{
    private $VoucherService;
    private $RecipientService;
    private $RedeemTransformer;
    private $VoucherRedeemRequestValidator;

    public function __construct(Container $container)
    {
        $this->VoucherService = $container->get('VoucherService');
        $this->RecipientService = $container->get('RecipientService');
        $this->RedeemTransformer = $container->get('RedeemTransformer');
        $this->VoucherRedeemRequestValidator = $container->get('VoucherRedeemRequestValidator');
    }

    public function redeem($request, $response)
    {
        $params = $request->getParsedBody();
        $params = $this->VoucherRedeemRequestValidator->sanitize($params);
        $this->VoucherRedeemRequestValidator->validate($params);
        list('email'=>$email, 'code'=>$code) = $params;
        $recipient = $this->RecipientService->getByEmail($email);
        $offer = $this->VoucherService->redeem($code, $recipient);
        $data = $this->toFractalResponse(
            $offer,
            $this->RedeemTransformer
        );
        return $response->withJson($data);
    }
}
