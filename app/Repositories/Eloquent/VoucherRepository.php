<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\VoucherRepositoryInterface;

class VoucherRepository implements VoucherRepositoryInterface
{
    private $VoucherModel;

    public function __construct($container)
    {
        $this->VoucherModel = $container->get('VoucherModel');
    }

    public function getAll()
    {
        return $this->VoucherModel->orderBy('id', 'desc')->get();
    }

    public function getByRecipient($id)
    {
        return $this->VoucherModel->where('recipient_id', $id)->get();
    }

    public function create($data)
    {
        return $this->VoucherModel->create($data);
    }
}
