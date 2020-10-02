<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicesubcategory extends Model
{
    use HasFactory;

    public function servicecategory()
    {
    	return $this->belongsTo('\App\Models\Servicecategory');
    }

    public function services()
    {
    	return $this->hasMany('\App\Models\Service');
    }
}
