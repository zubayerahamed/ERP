<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'short_desc',
        'desc',
        'thumbnail_id',
        'active'
    ];

    public function thumbnail(){
        return $this->hasOne(Media::class, 'id', 'thumbnail_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'products_categories');
    }

    public function hasCategory($categorySlug){
        return $this->categories->contains('slug', $categorySlug);
    }

    public function attrs(){
        return $this->belongsToMany(Attribute::class, 'products_attributes');
    }

    public function hasAttr($catslug){
        return $this->attrs->contains('slug', $catslug);
    }

    public function terms(){
        return $this->belongsToMany(Term::class, 'products_terms');
    }
    
    public function hasTerm($termslug){
        return $this->terms->contains('slug', $termslug);
    }
}
