<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localicades extends Model
{
    use HasFactory;

    protected $fillable = [
      'ibge_id',
      'ibge_name'
    ];
}
