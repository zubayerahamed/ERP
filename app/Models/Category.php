<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_category_id',
        'image',
        'seqn',
        'active'
    ];

    public function getImageAttribute($value)
    {
        return $value ? '/upload/category/' . $value : "/assets/admin-assets/img/category-default.png";
    }

    public function parentCategory()
    {
        return $this->hasOne(Category::class, 'id', 'parent_category_id');
    }


    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'id');
    }

    public function getAllNestedChildCategoriesAttribute()
    {
        $allChildCategoeis = [];
        foreach ($this->childCategories as $child) {
            $allChildCategoeis = $this->loopThroughEachChild($child, $allChildCategoeis);
        }
        return $allChildCategoeis;
    }

    public function loopThroughEachChild($category, $allChildCategoeis)
    {
        if ($category == null) return $allChildCategoeis;
        array_push($allChildCategoeis, $category);

        foreach ($category->childCategories as $child) {
            $allChildCategoeis = $this->loopThroughEachChild($child, $allChildCategoeis);
        }

        return $allChildCategoeis;
    }

    public function getAllCategoriesExceptChildsAndSelfAttribute()
    {
        $allCategoriesExceptChildsAndSelf = Category::all();
        foreach ($allCategoriesExceptChildsAndSelf as $key => $c) {
            if ($this->slug == $c->slug) {
                unset($allCategoriesExceptChildsAndSelf[$key]);
            }
        }
        foreach ($this->allNestedChildCategories as $nc) {
            foreach ($allCategoriesExceptChildsAndSelf as $key => $c) {
                if ($nc->slug == $c->slug) {
                    unset($allCategoriesExceptChildsAndSelf[$key]);
                }
            }
        }
        return $allCategoriesExceptChildsAndSelf;
    }


    public static function nestable($categories)
    {
        foreach ($categories as $category) {
            if (!$category->childCategories->isEmpty()) {
                $category->childCategories = self::nestable($category->children);
            }
        }

        return $categories;
    }
}
