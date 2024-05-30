<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location2;

class Measurement2 extends Model
{
    use HasFactory;

    protected $table = 'measurements2';

    protected $guarded = ['idMeasurement'];

    protected $primaryKey = 'idMeasurement'; // ??
    
    public function location(){
        return $this->belongsTo(Location2::class, 'idLocation');
    }
}
