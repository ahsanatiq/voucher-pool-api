<?php
namespace App\Models;

class VoucherModel extends BaseModel
{
    protected $table = 'used_vouchers';

    protected $fillable = [
        'used_code'
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
