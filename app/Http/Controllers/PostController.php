<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // dd(request('search'));
        //Method with() untuk menghindari n=1 problem atau sebagai eagerloading
        //$posts=Post::with(['author','category'])->latest()->get(); eager  loading di controller

        // Star untuk membuat judul mengarah ke category atau author
        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug',request('category'));
            $title = ' in '.$category->name;
        }
        if(request('author')){
            $author = User::firstWhere('user_name',request('author'));
            $title = ' by '.$author->name;
        }

        $posts=Post::latest()->filter(request(['search','category','author']))->paginate(7)->withQueryString();
        // withQueryString() di gunakan untuk mengembalikan string yang sudah terhapus, jadi semua query string yang ada sebelumnya bawa atau tampilkan
        return view('posts', ["title" => "All Post".$title, "active" => 'posts'],compact('posts'));
    }
    public function post(Post $post)
    {
        return view('post',["title" =>"Single Post","active" => 'posts'],compact('post'));
    }
}
