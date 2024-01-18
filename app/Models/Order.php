<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['title','restaurant_id','total_cost'];
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }
  
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'order_foods')->withPivot('quantity');
    }

    
}
