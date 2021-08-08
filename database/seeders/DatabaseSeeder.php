<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $value = 50000;
        // print($value.' times, START ========='.PHP_EOL);
        // print(Carbon::now().PHP_EOL);
        // // $user = User::where('name', 'admin');
        // // if ($user === null) {
        // //     DB::table('users')->insert([
        // //         'name' => 'admin',
        // //         'email' => 'admin@gmail.com',
        // //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // //         'remember_token' => Str::random(10),
        // //     ]);
        // // }
        // // User::factory(1000)->create();
        // Comment::factory($value)->create();
        // print(Carbon::now().PHP_EOL);
        // print('============= END ============='.PHP_EOL);

        // Tag::factory(100)->create();

        for ($i = 0; $i < 1000; $i++) {
            $post = DB::table('posts')->select(['id'])->inRandomOrder()->first();
            $tag = DB::table('tags')->select(['id'])->inRandomOrder()->first();


            DB::table('tags_of_post')->insert([
                'post_id' => $post->id,
                'tag_id' => $tag->id
            ]);
        }
    }
}
