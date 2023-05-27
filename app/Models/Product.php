<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

        protected $table = 'products';

        // protected $fillable = ['name', 'price', 'country', 'weight', 'shipping_rate', 'discount'];
    
        
        protected $fillable = [
            'name', 'price', 'shipping_country', 'weight'
        ];

        public function shipping()
        {
            return $this->belongsTo('App\Models\Shipping', 'source');
        }
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function cartItems()
    {
        return $this->hasMany('App\Models\CartItem');
    }
}



// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Product extends Model
// {
//     protected $table = 'products';
// }
