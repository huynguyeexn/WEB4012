<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;
    // use SoftDeletes;

    public function cacheKey()
    {
        return sprintf(
            "%s/%s-%s",
            $this->getTable(),
            $this->getKey(),
            $this->updated_at->timestamp
        );
    }

    public function children()
    {
        // return $this->hasMany(self::class, 'parent_id', 'id')->withTrashed();
        return $this->hasMany(self::class, 'parent_id', 'id');
    }
    public function parent()
    {
        // return $this->belongsTo(self::class, 'parent_id')->withTrashed();
        return $this->belongsTo(self::class, 'parent_id');
    }


    public static function slug($slug)
    {
        return self::where('slug', 'like', $slug)->first();
    }

    public function getTopNavBar($limit = 8)
    {
        $category = new Category();

        $category = $category->where('parent_id', null)->whereNotNull('order')->orderBy('order', 'asc')->limit($limit)->get();

        $category->each(
            function (&$cat) {
                $cat['children'] = $cat->children()->get();
            }
        );

        return $category;
    }

    public function getAll()
    {
        $category = new Category();

        $category = $category->where('parent_id', null)->whereNotNull('order')->orderBy('order', 'asc')->get();

        $category->each(
            function (&$cat) {
                $cat['children'] = $cat->children()->get();
            }
        );

        return $category;
    }

    public function post()
    {
        return $this->hasMany(Post::class, 'cat_id');
    }

    public function countPost()
    {
        return $this->post()->count();
    }
}
