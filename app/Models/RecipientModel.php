<?php
namespace App\Models;

class RecipientModel extends BaseModel
{
    protected $table = 'recipients';

    protected $fillable = [
        'name',
        'email'
    ];

    protected $dates = ['deleted_at'];

    public function vouchers()
    {
        $this->hasMany(VoucherModel::class);
    }
}
