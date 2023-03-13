<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'short_desc',
        'desc',
        'thumbnail',
        'active'
    ];

    public function categories(){
        return $this->belongsToMany(Category::class, 'products_categories');
    }

    public function hasCategory($categorySlug){
        return $this->categories->contains('slug', $categorySlug);
    }
}
