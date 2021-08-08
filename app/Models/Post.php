<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function cacheKey()
    {
        return sprintf(
            "%s/%s-%s",
            $this->getTable(),
            $this->getKey(),
            $this->updated_at->timestamp
        );
    }

    protected static function boot()
    {
        parent::boot();

        // Order by date ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('date', 'desc');
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function countPost()
    {
        return Cache::remember(createCacheKey('PostModel', 'countPost'), 60, function () {
            return $this->count();
        });
    }

    public function tagsOfPost()
    {
        return $this->hasMany(TagsOfPost::class);
    }
}
