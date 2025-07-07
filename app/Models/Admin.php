<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Tentukan guard yang digunakan oleh model ini.
     */
    protected $guard = 'admin';

    /**
     * Atribut yang bisa diisi.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Atribut yang harus disembunyikan.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
