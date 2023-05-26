<?php


use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminCategoriController;
use App\Http\Controllers\DashboardPostController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('index', [
        "title" => "Home",
        "active" => 'home'
    ]);
});
Route::get('/about', function () {
    return  view('about', [
        "title" => "About",
        "active" => 'about',
        "name" => 'Euis Safania',
        "email" => "euissafania@gmail.com",
        "img" => "foto1.jfif"
    ]);
});

Route::get('/posts',[PostController::class, 'index']);
Route::get('/post/{post:slug}',[PostController::class, 'post']);

Route::get('/categories', function(){
    return view('categories',[
        'title' => 'Post Categories',
        'active' => 'categories',
        'categories' => Category::all()
    ]);
});

// Untuk LOgin
// name('login') di gunakan agar dan jika user yg blm login akan mengakses dashboar maka akan di redict ke halaman web
//middleware('guest') untuk user yg blm login
//middleware('auth') untuk user yang sudah login
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);

Route::get('/register',[RegisterController::class, 'index'])->middleware('guest');
Route::post('/register',[RegisterController::class, 'store']);

Route::get('/dashboard',function(){ return view('dashboard.index');} )->middleware('auth');

// Route membuat slug otomatis
Route::get('/dashboard/posts/checkSlug',[DashboardPostController::class, 'checkSlug'])->middleware('auth');
//Rout untuk CRUD Otomatis
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');
//Route resource Category  :: except('show') ini untuk url yang ga ke pake
Route::resource('/dashboard/categories', AdminCategoriController::class)->except('show')->middleware('admin');


//
// Route::get('/categories/{category:slug}', function(Category $category){
//     return view('posts',[
//         'title' => "Post By Category : $category->name",
//         'active' => 'categories',
//         'posts' => $category->posts->load('category', 'author'),
//         // 'category' => $category->name
//     ]);
// });
// Route::get('/author/{author:user_name}', function(User $author){
//     return view('posts',[
//         'title' => "Post By Author : $author->name",
//         'active' => 'author',
//         'posts' => $author->posts->load('category','author'),
     
//     ]);
// });
