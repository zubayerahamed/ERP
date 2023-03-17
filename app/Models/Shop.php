<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'seqn',
        'active',
        'outlet_id'
    ];

    public function counters(){
        return $this->hasMany(Counter::class, 'shop_id', 'id');
    }

    public function outlet(){
        return $this->belongsTo(Outlet::class, 'outlet_id');
    }
}
