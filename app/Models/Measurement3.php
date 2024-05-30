<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement3 extends Model
{
    use HasFactory;
    protected $table = 'measurements3';
    protected $guarded = ['idMeasurement'];

    protected $primaryKey = 'idMeasurement'; // ??
    
    public function location(){
        return $this->belongsTo(Location3::class, 'idLocation');
    }
}
