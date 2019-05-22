<?php
namespace App\Models;

use App\Models\OfferModel;
use App\Models\RecipientModel;

class VoucherModel extends BaseModel
{
    protected $table = 'used_vouchers';

    protected $fillable = [
        'used_code',
        'recipient_id',
        'offer_id'
    ];

    protected $dates = ['deleted_at'];

    public function recipient()
    {
        $this->belongsTo(RecipientModel::class);
    }

    public function offer()
    {
        $this->belongsTo(OfferModel::class);
    }
}
