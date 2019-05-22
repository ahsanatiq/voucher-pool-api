<?php
namespace App\Models;

class OfferModel extends BaseModel
{
    protected $table = 'offers';

    protected $fillable = [
        'name',
        'discount',
        'expire_at'
    ];

    protected $dates = ['deleted_at'];

    public function vouchers()
    {
        $this->hasMany(VoucherModel::class);
    }
}
