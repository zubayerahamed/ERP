<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capability extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'seqn',
        'capability_group_id'
    ];

    public function capabilityGroup(){
        return $this->belongsTo(CapabilityGroup::class, 'capability_group_id');
    }
}
