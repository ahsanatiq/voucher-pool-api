<?php
namespace App\Services;

use Slim\Container;

class RecipientService extends BaseService
{
    private $recipientRepository;

    public function __construct(Container $container)
    {
        $this->recipientRepository = $container->get('RecipientRepository');
    }

    public function getAll()
    {
        return $this->recipientRepository->getAll();
    }
}
