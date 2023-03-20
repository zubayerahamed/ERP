<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'short_desc',
        'desc',
        'thumbnail_id',
        'status',
        'published_date',
        'published_time',
        'visibility',
        'sticky',
        'allow_comments',
        'default_comment_status',
        'admin_id',
        'post_visited',
        'allow_likes',
        'allow_ratings',
        'featured_post'
    ];

    public function thumbnail(){
        return $this->hasOne(Media::class, 'id', 'thumbnail_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'posts_categories');
    }

    public function hasCategory($categorySlug){
        return $this->categories->contains('slug', $categorySlug);
    }
}
