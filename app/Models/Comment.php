<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class Comment extends Model
// {   
//     use HasFactory;
// }
class Comment extends Model
{
    protected $fillable = ['post_id', 'name', 'comment'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    use HasFactory;
}
