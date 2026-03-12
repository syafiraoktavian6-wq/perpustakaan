<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'PeminjamanID';

    protected $fillable = [
        'UserID',
        'BukuID',
        'TanggalPeminjaman',
        'TanggalPengembalian',
        'StatusPeminjaman'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'UserID', 'UserID');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'BukuID', 'BukuID');
    }
    public function kembalikan($id)
    {
        $peminjaman = \App\Models\Peminjaman::find($id);

        $peminjaman->update([
            'TanggalPengembalian' => now(),
            'StatusPeminjaman' => 'Sudah Dikembalikan'
        ]);

        return redirect()->back()->with('success', 'Buku telah berhasil dikembalikan.');
    }
}