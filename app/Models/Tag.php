<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    use HasFactory;


    public function countPost()
    {
        return DB::table('tags_of_post')->where('tag_id', $this->id)->count();
    }

    public function tagsOfPost()
    {
        return $this->hasMany(TagsOfPost::class);
    }
}
