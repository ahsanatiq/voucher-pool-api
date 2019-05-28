<?php
namespace App\Repositories\Collection;

use App\Repositories\Contracts\RecipientRepositoryInterface;
use Illuminate\Support\Collection;

class RecipientRepository implements RecipientRepositoryInterface
{
    public $recipients;

    public function __construct()
    {
        $this->recipients = new Collection();
    }

    public function getAll()
    {
        return $this->recipients->all();
    }

    public function getByEmail($email)
    {
        return $this->recipients->where('email', $email)->first();
    }

    public function getById($id)
    {
        return $this->recipients->where('id', $id)->first();
    }

    public function create($data)
    {
        $maxid = $this->recipients->max('id');
        $data['id'] = $maxid ? ++$maxid : 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->recipients->push($data);
        return $this->getById($data['id']);
    }
}
