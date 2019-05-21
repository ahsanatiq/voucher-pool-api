<?php
namespace App\Services;

use Slim\Container;

class RecipientService extends BaseService
{
    private $recipientRepository;

    public function __construct(Container $container) {
        $this->recipientRepository = $container->get('RecipientRepository');
        // print_r($this->recipientRepository);
    }

    public function getAll()
    {
        return $this->recipientRepository->getAll();
    }
}
