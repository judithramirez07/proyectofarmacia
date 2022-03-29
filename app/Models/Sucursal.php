<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $table = 'sucursal';
    public $timestamps = false;

    public function productos()
    {
        return  $this->belongsToMany(Producto::class);
    }
}