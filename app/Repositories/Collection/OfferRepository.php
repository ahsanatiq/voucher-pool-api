<?php
namespace App\Repositories\Collection;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Repositories\Contracts\OfferRepositoryInterface;

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

    public function getAllActive()
    {
        return $this->offers->where('expire_at_carbon', '>=', Carbon::tomorrow());
    }

    public function getById($id)
    {
        return $this->offers->where('id', $id)->first();
    }

    public function create($data)
    {
        $maxid = $this->offers->max('id');
        $data['id'] = $maxid ? ++$maxid : 1;
        $data['expire_at_carbon'] = Carbon::parse($data['expire_at']);
        $data['created_at'] = Carbon::now()->toDateString();
        $data['updated_at'] = Carbon::now()->toDateString();
        $this->offers->push($data);
        return $this->getById($data['id']);
    }
}
