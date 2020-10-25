<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicecategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','status','details','image'];

    public function servicesubcategories()
    {
    	return $this->hasMany('\App\Models\Servicesubcategory');
    }
}
