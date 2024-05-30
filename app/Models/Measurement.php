<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

class Measurement extends Model
{
    use HasFactory;

    protected $guarded = ['idMeasurement'];

    protected $primaryKey = 'idMeasurement'; // ??
    
    public function location(){
        return $this->belongsTo(Location::class, 'idLocation');
    }

}
