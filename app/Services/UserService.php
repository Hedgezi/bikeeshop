<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function store(array $data): bool
    {
        $user = new User();
        $user->fill($data);

        return $user->save();
    }

    public function destroy(User $user): null
    {
        $user->deleteOrFail();
    }

    public function update(User $user, array $data): bool
    {
        $user->fill($data);

        return $user->update();
    }
}
