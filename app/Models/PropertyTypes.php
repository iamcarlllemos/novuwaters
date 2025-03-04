<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTypes extends Model
{
    use HasFactory;

    protected $table = 'property_types';

    protected $fillable = [
        'name',
        'description'
    ];

}
