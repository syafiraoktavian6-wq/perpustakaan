<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    
    protected $table = 'buku'; 
    protected $primaryKey = 'BukuID';
    public $timestamps = false; 

    protected $fillable = ['Judul', 'Penulis', 'Penerbit', 'TahunTerbit'];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'BukuID');
    }

    public function kategoribuku()
    {
        return $this->belongsToMany(KategoriBuku::class, 'kategoribuku_relasi', 'BukuID', 'KategoriID');
    }
    public function ulasan()
{
    return $this->hasMany(UlasanBuku::class, 'BukuID', 'BukuID');
}
}