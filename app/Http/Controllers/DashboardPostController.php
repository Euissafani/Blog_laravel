<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.posts.index', [
            // where('user_id', auth()->user()->id) artinya ambilkan user_id yang sama dengan id yang sedang login
            'posts' => Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categries' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ddd($request); untuk melihat apa aja yang di kirimkan 
        //untuk mengecek apakah imge masuk ke foleder public storage tidak
        // return $request->file('image')->store('post-images');

        $validateData = $request -> validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            // ukuran satuannya kilobyt
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        // untuk mengecek ada img baru ga kalo ga ada pake img lama
        if($request->file('image')){
            $validateData['image'] =  $request->file('image')->store('post-images');
        }

        $validateData['user_id'] = auth()->user()->id;
        // str Limit untuk excerpt atau menyingkat string
        // strip_tags untuk menghilangkan tag html sama seperti {{ !! }}
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::create($validateData);
        return redirect('/dashboard/posts')->with('success', 'Data Behasil Di tambah');

        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    //  Detail
    public function show(Post $post)
    {
        return view('dashboard.posts.show',[
            'post'=>$post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categries' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    // $request adalah data baru dan $post data lama
    public function update(Request $request, Post $post)
    {

    //untuk permasalahan slug jadi kita hilangkan dulu aturan slug di awal kemudian kita tambahkan arturan di slug yg baru
        $rules =[
            'title' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ];

        
        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }
        
        $validateData = $request->validate($rules);
        
        // untuk mengecek ada img baru ga kalo ga ada pake img lama
        if($request->file('image')){
           if($request->oldImage){
             Storage::delete($request->oldImage);
           }
           $validateData['image'] =  $request->file('image')->store('post-images');
       }
        $validateData['user_id'] = auth()->user()->id;
        // str Limit untuk excerpt atau menyingkat string
        // strip_tags untuk menghilangkan tag html sama seperti {{ !! }}
        $validateData['excerpt'] = Str::limit(strip_tags($request->body), 200);

        Post::where('id', $post->id)
            ->update($validateData);
        return redirect('/dashboard/posts')->with('success', 'Data Behasil Di Update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->image){
            Storage::delete($post->image);
          }
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Data Behasil Di delete');
    }
//Untuk membuat slug otomatis
    public function checkSlug(Request $request)
    {
       $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
       return response()->json(['slug' =>$slug]);
    }
}
