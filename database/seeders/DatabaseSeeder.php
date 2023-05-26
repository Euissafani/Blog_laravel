<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

       //Buat data seed manual
       User::create([
        'name' =>'Euis Safania',
        'user_name' => 'euissafania',
        'email' => 'euissafania@gmail',
        'password'=> bcrypt('password')
       ]);
    //    User::create([
    //     'name' =>'Sandhika Galih',
    //     'email' => 'sandhikagalih@gmail',
    //     'password'=> bcrypt('232355')
    //    ]);

    User::factory(3)->create();

       Category::create([
        'name' => 'Web Programming',
        'slug' => 'web-programming'
       ]);
       Category::create([
         'name' => 'Web Design',
         'slug' => 'web-design'
        ]);
       Category::create([
        'name' => 'Personal',
        'slug' => 'personal'
       ]);
       Post::factory(20)->create();

    //    Post::create([
    //     'title' => 'Judul Pertama',
    //     'slug' => 'judul-pertama',
    //     'excerpt' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores quis earum consequatur quod laboriosam. 
    //     Necessitatibus possimus eos tempora quas explicabo fuga.',
    //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores quis earum consequatur quod laboriosam. 
    //     Necessitatibus possimus eos tempora quas explicabo fuga. Voluptatibus exercitationem voluptate dolorum molestiae, 
    //     quae minima eaque ipsum earum expedita provident veritatis nemo dicta ratione ipsa recusandae praesentium vel, 
    //     aliquam excepturi fugiat nobis consectetur maxime. Amet laboriosam beatae, corporis expedita nesciunt, sed, sit
    //     quam a fugit dignissimos consequuntur temporibus omnis nisi et fugiat ullam ratione reprehenderit voluptas. Optio, 
    //     vero at est velit laudantium amet, ullam distinctio ea tempore minima repudiandae labore minus recusandae quasi 
    //     impedit ducimus inventore neque ut cumque! At neque quam maiores, velit, rerum exercitationem minus impedit soluta 
    //     quia nobis nemo sapiente, perferendis veritatis architecto eius assumenda earum modi reprehenderit suscipit labore 
    //     sint! Consectetur, quo impedit.',
    //     'category_id' => 1,
    //     'user_id' => 1
    //    ]);
    //    Post::create([
    //     'title' => 'Judul Ke Dua',
    //     'slug' => 'judul-kedua',
    //     'excerpt' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores quis earum consequatur quod laboriosam. 
    //     Necessitatibus possimus eos tempora quas explicabo fuga.',
    //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores quis earum consequatur quod laboriosam. 
    //     Necessitatibus possimus eos tempora quas explicabo fuga. Voluptatibus exercitationem voluptate dolorum molestiae, 
    //     quae minima eaque ipsum earum expedita provident veritatis nemo dicta ratione ipsa recusandae praesentium vel, 
    //     aliquam excepturi fugiat nobis consectetur maxime. Amet laboriosam beatae, corporis expedita nesciunt, sed, sit
    //     quam a fugit dignissimos consequuntur temporibus omnis nisi et fugiat ullam ratione reprehenderit voluptas. Optio, 
    //     vero at est velit laudantium amet, ullam distinctio ea tempore minima repudiandae labore minus recusandae quasi 
    //     impedit ducimus inventore neque ut cumque! At neque quam maiores, velit, rerum exercitationem minus impedit soluta 
    //     quia nobis nemo sapiente, perferendis veritatis architecto eius assumenda earum modi reprehenderit suscipit labore 
    //     sint! Consectetur, quo impedit.',
    //     'category_id' => 1,
    //     'user_id' => 2
    //    ]);
    //    Post::create([
    //     'title' => 'Judul Ke Tiga',
    //     'slug' => 'judul-ketiga',
    //     'excerpt' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores quis earum consequatur quod laboriosam. 
    //     Necessitatibus possimus eos tempora quas explicabo fuga.',
    //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Asperiores quis earum consequatur quod laboriosam. 
    //     Necessitatibus possimus eos tempora quas explicabo fuga. Voluptatibus exercitationem voluptate dolorum molestiae, 
    //     quae minima eaque ipsum earum expedita provident veritatis nemo dicta ratione ipsa recusandae praesentium vel, 
    //     aliquam excepturi fugiat nobis consectetur maxime. Amet laboriosam beatae, corporis expedita nesciunt, sed, sit
    //     quam a fugit dignissimos consequuntur temporibus omnis nisi et fugiat ullam ratione reprehenderit voluptas. Optio, 
    //     vero at est velit laudantium amet, ullam distinctio ea tempore minima repudiandae labore minus recusandae quasi 
    //     impedit ducimus inventore neque ut cumque! At neque quam maiores, velit, rerum exercitationem minus impedit soluta 
    //     quia nobis nemo sapiente, perferendis veritatis architecto eius assumenda earum modi reprehenderit suscipit labore 
    //     sint! Consectetur, quo impedit.',
    //     'category_id' => 2,
    //     'user_id' => 1
    //    ]);

    }
}
