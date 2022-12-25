<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jelo extends Model
{
    use HasFactory;

    protected $table = 'jelo';

    protected $fillable = ['nazivJela', 'cena', 'porekloId' , 'kategorijaId'];
}
