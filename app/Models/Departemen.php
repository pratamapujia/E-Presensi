<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Departemen extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'departemen';
    protected $primaryKey = 'id_departemen';
    protected $fillable = [
        'kd_departemen',
        'nama_departemen',
    ];
}
