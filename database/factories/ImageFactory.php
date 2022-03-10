<?php

namespace Database\Factories;

use App\Models\Post;
use App\Traits\RelatedToUsers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory {

    use RelatedToUsers;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'path' => storage_path($this->faker->word . '.png'),
        ];
    }

    public function withPost(Post $post) {
        return $this->state(function (array $attributes) use ($post) {
            return [
                'imageable_type' => get_class($post),
                'imageable_id' => $post->id,
            ];
        });
    }


}
