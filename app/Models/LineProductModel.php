<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineProductModel extends Model
{
    use HasFactory;
    protected $table = 'linea_producto';
    protected $primaryKey = 'id_linea';
    public $timestamps = false;
}
