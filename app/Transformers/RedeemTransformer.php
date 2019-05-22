<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class RedeemTransformer extends TransformerAbstract
{
    public function transform(array $data)
    {
        return [
            'discount' => (float)$data['discount'],
        ];
    }
}
