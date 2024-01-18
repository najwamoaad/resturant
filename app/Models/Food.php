<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable = ['name','price',];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_foods')
            ->withTimestamps();
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_foods');
    }
}
