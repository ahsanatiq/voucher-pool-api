<?php
namespace App\Repositories\Collection;

use App\Repositories\Contracts\OfferRepositoryInterface;
use Illuminate\Support\Collection;

class OfferRepository implements OfferRepositoryInterface
{
    public $offers;

    public function __construct()
    {
        $this->offers = new Collection();
    }

    public function getAll()
    {

        return $this->offers->all();
    }

    public function create($data)
    {
        $maxid = $this->offers->max('id');
        $data['id'] = $maxid ? ++$maxid : 1;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->offers->push($data);
        return $data;
    }
}
