<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class RecipientTransformer extends TransformerAbstract
{
    public function transform(array $recipient)
    {
        return [
            'id'              => (int) $recipient['id'],
            'name'            => $recipient['name'],
            'email'           => $recipient['email'],
            'created_at'      => Carbon::parse($recipient['created_at'])->toDateTimeString(),
            'updated_at'      => Carbon::parse($recipient['updated_at'])->toDateTimeString(),
        ];
    }
}
