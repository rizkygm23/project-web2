<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   protected $fillable = [
    'user_id',
    'title',
    'slug',
    'thumbnail',
    'content',
    'author',
    'published_at',
];

    public function user()
{
    return $this->belongsTo(User::class);
}
public function comments()
{
    return $this->hasMany(Comment::class);
}
    use HasFactory;

    public function getThumbnailUrlAttribute()
    {
        return asset('storage/thumbnails/' . $this->thumbnail);
    }
    
    
    

}




