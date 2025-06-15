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
    'category_id',
    'views',
    'is_premium'
];
public function incrementViews()
{
    $this->views++;
    $this->save();
}

public function index(){
    return view('index');
}

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
        return asset('storage/' . $this->thumbnail);
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}

    
    
    

}




