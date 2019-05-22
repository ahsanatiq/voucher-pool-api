<?php

namespace App\Transformers;

use Carbon\Carbon;
use App\Models\OfferModel;
use League\Fractal\TransformerAbstract;

class OfferTransformer extends TransformerAbstract
{
    public function transform(OfferModel $data)
    {
        return [
            'id'         => (int) $data->id,
            'name'       => $data->name,
            'discount'   => (float)$data->discount,
            'expire_at'  => Carbon::parse($data->expire_at)->toDateString(),
            'created_at' => Carbon::parse($data->created_at)->format(\DateTime::ATOM),
            'updated_at' => Carbon::parse($data->updated_at)->format(\DateTime::ATOM),
        ];
    }
}
