<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location3 extends Model
{
    use HasFactory;

    protected $table = 'locations3';

    protected $guarded = ['idLocation'];

    protected $primaryKey = 'idLocation'; // ??
}
