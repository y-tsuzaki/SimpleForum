<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Thread;
use App\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();
        factory(Thread::class, 50)->create()->each(function ($thread){
            for ($i=0; $i<rand(0, 20); $i++) {
                $rand_user = User::inRandomOrder()->first();
                factory(Post::class, 1)->create(
                    ['thread_id' => $thread->id, 'user_id' => $rand_user->id]);
            }
        });
    }
}
