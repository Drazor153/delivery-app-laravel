<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;

    protected $fillable = ['email_usuario'];

    protected $table = 'carro';
    protected $primaryKey = 'id_carro';
    public $timestamps = false;

}
