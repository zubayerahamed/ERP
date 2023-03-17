<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'seqn',
        'active',
        'business_id'
    ];

    public function shops(){
        return $this->hasMany(Shop::class, 'outlet_id', 'id');
    }

    public function business(){
        return $this->belongsTo(Business::class, 'business_id');
    }
}
