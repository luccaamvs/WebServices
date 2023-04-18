<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nomedacategoria'];

    protected $primaryKey = 'pkcategoria';

    protected $table = 'categorias';

    public $incrementing = true;

    public $timestamps = false;
}
