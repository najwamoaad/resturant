<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant_food extends Model
{
    use HasFactory;
    protected $fillable = [
        'restaurant_id',
        'food_id',
    ];
  
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
