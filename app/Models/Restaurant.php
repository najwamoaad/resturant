<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = ['name','cuisine','address','contact','rating',];

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'restaurant_foods')
            ->withTimestamps();
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
