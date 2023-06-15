<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function pesanan_detail() 
	{
	     return $this->hasMany(detail_penjualan::class);
	}
}
