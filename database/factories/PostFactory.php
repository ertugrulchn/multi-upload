<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Traits\RelatedToUsers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory {

    use RelatedToUsers;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $title = $this->faker->sentence(rand(5, 12));

        return [
            'title' => Str::title($title),
            'slug' => Str::slug($title),
            'content' => implode("\n\r", $this->faker->paragraphs(7)),
        ];
    }

    public function published() {
        return $this->state(fn(array $attributes) => ['status' => 'published']);
    }


}
