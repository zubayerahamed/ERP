<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color',
        'attribute_id',
        'seqn',
        'active'
    ];

    public function attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
}
