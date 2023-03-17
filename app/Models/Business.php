<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'seqn',
        'active',
        'admin_id'
    ];

    public function outlets(){
        return $this->hasMany(Outlet::class, 'business_id', 'id');
    }
}
