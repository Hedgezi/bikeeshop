<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\User;

class UserService
{
    public function store(array $data): bool
    {
        $user = new User();
        $user->fill($data);
        $cart = new Cart();
        $cart->user_id = $user->id;
        $cart->save();

        return $user->save();
    }

    public function destroy(User $user): void
    {
        $user->deleteOrFail();
    }

    public function update(User $user, array $data): bool
    {
        $user->fill($data);

        return $user->update();
    }
}
