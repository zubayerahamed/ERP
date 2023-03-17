<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'filter_type',
        'seqn',
        'active'
    ];

    public function terms()
    {
        return $this->hasMany(Term::class, 'attribute_id', 'id');
    }

    // public function getTerms()
    // {
    //     return $this->hasMany(Term::class, 'attribute_id', 'id');
    // }
}
