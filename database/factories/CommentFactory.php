<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $post = DB::table('posts')->select(['id','date'])->inRandomOrder()->first();

        $hiredOn = Carbon::parse($post->date);
        $today = Carbon::now();
        // How many days have passed since they were hired
        $diffInDays = $today->diffInDays($hiredOn);
        // Get a random number (in days) between hire date and today
        $randomBetweenDays = rand(0, $diffInDays);
        // Subtract that many days from today to get our random date between hire and today
        $randomBetweenDate = $today->copy()->subDays($randomBetweenDays);

        return [
            //
            'post_id' => $post->id,
            'user_id' => User::select('id')->inRandomOrder()->first(),
            'content' => $this->faker->realTextBetween(10, 100, 2),
            'like' => random_int(0, 100),
            'hidden' => random_int(0, 1),
            'date' => $randomBetweenDate,
        ];
    }
}
