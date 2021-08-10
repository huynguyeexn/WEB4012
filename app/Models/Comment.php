<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        // Order by date ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('date', 'desc');
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class)->withTrashed();
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
