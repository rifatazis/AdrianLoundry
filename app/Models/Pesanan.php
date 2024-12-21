<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan'; 
    protected $primaryKey = 'id_pesanan';
    protected $fillable = [
        'kode_pesanan',
        'id_user',  
        'id_layanan',
        'berat',
        'total_harga',
        'tanggal_pesanan',
        'status_pesanan',
        'nama_pelanggan',
    ]; 

    protected $casts = [
        'tanggal_pesanan' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(Users::class, 'id_user', 'id_user');
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}
