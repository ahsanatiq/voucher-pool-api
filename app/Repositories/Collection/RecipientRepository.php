<?php
namespace App\Repositories\Collection;

use App\Repositories\Contracts\RecipientRepositoryInterface;
use Illuminate\Support\Collection;

class RecipientRepository implements RecipientRepositoryInterface
{
    private $recipients;

    public function __construct()
    {
        $this->recipients = new Collection();
        container('logger')->info('new collection');
    }

    public function getAll()
    {
        container('logger')->info('all recipients:',$this->recipients->toArray());
        return $this->recipients->all();
    }

    public function create($data)
    {
        container('logger')->info('data:',$data);
        container('logger')->info('1recipients:',$this->recipients->toArray());
        $maxid = $this->recipients->max('id');
        $data['id'] = $maxid ? ++$maxid : 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->recipients->push($data);
        container('logger')->info('2new recipients:',$this->recipients->toArray());
        return $data;
    }
}
