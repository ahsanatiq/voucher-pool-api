<?php

namespace App\Transformers;

use App\Models\RecipientModel;
use League\Fractal\TransformerAbstract;

class RecipientTransformer extends TransformerAbstract
{
    public function transform(RecipientModel $recipient)
    {
        return [
            'id'              => (int) $recipient->id,
            'name'            => $recipient->name,
            'email'           => $recipient->email,
            'created_at'      => $recipient->created_at->format(\DateTime::ATOM),
            'updated_at'      => $recipient->updated_at->format(\DateTime::ATOM),
        ];
    }
}
