<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapabilityGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'seqn'
    ];

    public function capabilities(){
        return $this->hasMany(Capability::class, 'capability_group_id', 'id');
    }
}
