<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->command->info('Seeding Users');
        $users = User::factory(300)->create();
        $this->command->info('Seeding Super Admins');
        User::factory(3)->superAdmin()->create();

        foreach ($users as $user) {
            $this->command->info('Seeding Posts for ' . $user->name);
            $posts = Post::factory(rand(1, 20))
                ->withUser($user)
                ->create();

            foreach ($posts as $post) {
                $this->command->info('Seeding Images for ' . $post->title);
                Image::factory(rand(2, 7))
                    ->withUser($user)
                    ->withPost($post)
                    ->create();
            }

        }
    }

}
