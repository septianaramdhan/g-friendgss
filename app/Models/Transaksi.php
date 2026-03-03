<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'kode_transaksi',
        'total_harga',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
