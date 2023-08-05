<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function jenis()
    {
        return $this->belongsTo(JenisSampah::class, 'jenis_sampah_id');
    }

    public function sampah()
    {
        return $this->belongsTo(Sampah::class);
    }
}
