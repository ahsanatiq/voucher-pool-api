<?php
namespace App\Repositories\Collection;

use App\Repositories\Contracts\VoucherRepositoryInterface;
use Illuminate\Support\Collection;

class VoucherRepository implements VoucherRepositoryInterface
{
    public $vouchers;

    public function __construct()
    {
        $this->vouchers = new Collection();
    }

    public function getAll()
    {
        return $this->vouchers->all();
    }

    public function getById($id)
    {
        return $this->vouchers->where('id', $id)->first();
    }

    public function getByRecipient($id)
    {
        return $this->vouchers->where('recipient_id', $id);
    }

    public function create($data)
    {
        $maxid = $this->vouchers->max('id');
        $data['id'] = $maxid ? ++$maxid : 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->vouchers->push($data);
        return $this->getById($data['id']);
    }
}
