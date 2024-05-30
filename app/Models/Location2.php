<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location2 extends Model
{
    use HasFactory;

    protected $table = 'locations2';

    protected $guarded = ['idLocation'];

    protected $primaryKey = 'idLocation'; // ??
}
