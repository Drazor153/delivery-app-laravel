<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'password', 'nombre', 'apellido', 'telefono', 'direccion', 'rut', 'saldo', 'carro_activo'];

    protected $table = 'usuario';
    protected $primaryKey = 'email';
    protected $keyType = 'string';
    public $timestamps = false;
}
