<?php

namespace App\Models;

use App\Models\Lost;
use App\Models\Kategori;
use App\Models\DetailPenjualan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function lost()
    {
        return $this->hasMany(Lost::class);
    }

    public function detailPenjualan()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
