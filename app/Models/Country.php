<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'shipping_rate'];


    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
