<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\Category;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

$posts = Post::latest();

if (request('search')) {

	$posts->where('title', 'like', '%' . request('search') . '%')
		  ->orWhere('body', 'like', '%' . request('search') . '%');
}
	return view('posts', [
		'posts' => $posts->get(),
		'categories' => Category::all()
	]);
})->name('home');

Route::get('post/{post:slug}', function(Post $post){
	
	return view('post', [
		'posts' => $post
	]);
});

Route::get('categories/{category:slug}', function(Category $category){

	return view('posts',[
		'posts' => $category->posts,
		'categories' => Category::all(),
		'currentCategory' => $category
	]);
})->name('category');

Route::get('authors/{author:username}', function(User $author){

	return view('posts',[
		'posts' => $author->posts,
		'categories' => Category::all()
	]);
});