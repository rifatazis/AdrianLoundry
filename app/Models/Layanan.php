<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;
    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    protected $fillable = [
        'nama_layanan',
        'harga',
        'gambar'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_layanan', 'id_layanan');
    }
}
