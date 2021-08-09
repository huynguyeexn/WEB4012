<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'hidden',
    ];

    public function countPost()
    {
        return DB::table('tags_of_post')->where('tag_id', $this->id)->count();
    }

    public function tagsOfPost()
    {
        return $this->hasMany(TagsOfPost::class);
    }

    public function posts()
    {
        $listTag = $this->tagsOfPost()->get();
        $result = [];
        foreach ($listTag as $tag) {
            array_push($result, $tag->post);
        }
        return $result;
    }
}
