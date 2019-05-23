<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class RecipientVouchersTransformer extends TransformerAbstract
{
    public function transform($data)
    {
        return [
            'offer' => $data['offer'],
            'code'  => $data['code'],
        ];
    }
}
