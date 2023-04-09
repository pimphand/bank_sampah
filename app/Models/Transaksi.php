<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function details()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
    public function nasabah()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
