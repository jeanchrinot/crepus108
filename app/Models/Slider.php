<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
    	'title_1',
    	'title_2',
    	'button_1_name',
    	'button_2_name',
    	'button_1_url',
    	'button_2_url',
    	'description',
    	'image'
    ];
}
