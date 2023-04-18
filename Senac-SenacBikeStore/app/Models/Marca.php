<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = ['nomedamarca'];

    protected $primaryKey = 'pkmarca';

    protected $table = 'marcas';

    public $incrementing = true;

    public $timestamps = false;
}
