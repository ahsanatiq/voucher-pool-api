<?php
namespace App\Controllers;

use Slim\Container;

class RecipientController extends BaseController
{
    private $recipientService;
    private $recipientTransformer;

    public function __construct(Container $container)
    {
        $this->recipientService = $container->get('RecipientService');
        $this->recipientTransformer = $container->get('RecipientTransformer');
    }

    public function getList($req, $res)
    {
        $recipients = $this->recipientService->getAll();
        $data = $this->toFractalResponse(
            $recipients,
            $this->recipientTransformer
        );
        return $res->withJson($data);
    }

    public function getVouchers($request)
    {
        return 'ok';
    }
}
