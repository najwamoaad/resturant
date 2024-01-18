<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $fillable = ['order_id','user_id','delivery_type'];
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
