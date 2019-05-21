<?php
namespace App\Models;

class VoucherModel extends BaseModel
{
    protected $table = 'vouchers';

    protected $fillable = [
        'code',
        'used_at'
    ];

    protected $dates = ['deleted_at', 'used_at'];
}
