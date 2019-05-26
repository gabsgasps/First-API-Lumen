<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
    	'nome',
    	'cnpj',
    	'created_at',
    	'updated_at'
    ];
}
