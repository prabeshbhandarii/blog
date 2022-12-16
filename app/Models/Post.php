<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\PostController;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['category', 'author'];


    // use queryscope to reuse a query or encapsulate the syntax used to execute a query
    public function scopeFilter($query) {

        if (request('search')) {
            $query
                ->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('body', 'like', '%' . request('search') . '%');
        }
    }

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function author(){

        return $this->belongsTo(User::class, 'user_id');
    }
}
