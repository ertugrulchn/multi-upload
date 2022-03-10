<?php

namespace App\Traits;

use App\Models\User;

trait RelatedToUsers {

    public function withUser(User $user) {
        return $this->state(function (array $attributes) use ($user) {
            return ['user_id' => $user->id];
        });
    }
}
