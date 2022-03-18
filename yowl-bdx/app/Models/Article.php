<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'description',
        'category_id',
        'user_id'
    ];


//    get the author of the article
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //get the category of the article
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //get the comments of the article
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function article()
    {
        return $this->hasMany(Article::class);
    }
}
