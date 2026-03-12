<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'UserID';

    protected $fillable = [
        'Username',
        'Password',
        'Email',
        'NamaLengkap',
        'role',
        'Alamat',
    ];

    protected $hidden = [
        'Password', 
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'Password' => 'hashed', 
        ];
    }

    public function getAuthPassword()
    {
        return $this->Password;
    }
}