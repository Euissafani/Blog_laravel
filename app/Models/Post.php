<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use di bawah untuk slug otomatis
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory,Sluggable;
// Sluggable di gunakan untuk slug otomatis

      // protected $fillable = ['title','slug','excerpt','body'];
      protected $guarded =['id'];
      //salah satu eagerbloading yang di simpan di model
      protected $with = ['author','category'];
      
      //             model
      public function category()
      {
          return $this->belongsTo(Category::class);
      }
      public function author()
      {
          return $this->belongsTo(User::class, 'user_id');
      }
     
      // Search
      public function scopeFilter($query, array $filters)
      {
        // if(isset($filters['search']) ? $filters['search'] : false ){
        //     return $query->where('title','like','%'.$filters['search'].'%')
        //                  ->orWhere('body','like','%'.$filters['search'].'%');
        // }

        $query->when($filters['search'] ?? false, function($query, $search)
        {
            return $query->where('title','like','%'.$search.'%')
                         ->orWhere('body','like','%'.$search.'%');  
        });

        $query->when($filters['category'] ?? false, function($query, $category){
              return $query->whereHas('category', function($query) use($category){
                $query->where('slug', $category);
              });
        });

        $query->when($filters['author'] ?? false, fn($query,$author)=>
           $query->whereHas('author',fn($query)=>
            $query->where('user_name',$author)
         )
      );
      //     $query->when($filters['author'] ?? false, fn($query, $author){
        //       return $query->whereHas('author', function($query) use($author){
          //         $query->where('user_name', $author);
          //       });
          // });
        }
        // Untuk mengirim slug/ selain id secara otomatis tanpa manual route model binding di web
        public function getRouteKeyName()
        {
           return 'slug';
        }
        //Untuk slug otomatis
        public function sluggable(): array
        {
            return [
                'slug' => [
                    'source' => 'title'
                ]
            ];
        }
      }
