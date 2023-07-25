<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    function kategori()
    {
        return $this->belongsTo(JenisSampah::class, 'jenis_sampah_id');
    }
}
