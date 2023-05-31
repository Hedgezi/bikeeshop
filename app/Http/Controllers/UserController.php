<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
    )
    {

    }

    public function index(): View
    {
            return view('users.index', [
                'users' => User::paginate(10)
            ]);
    }


    public function create()
    {
        return view('users.form');
    }

    public function store(StoreUserRequest $request)
    {

        if ($this->userService->store($request->validated()) == false)
        {
            throw \Error::class;
        }
        return redirect('/admin/user');
    }

    public function edit(User $user)
    {
        return view("users.editform", [
            'user' => $user
        ]);
    }

    public function update(User $user, StoreUserRequest $request): RedirectResponse
    {
        if ($this->userService->update($user, $request->validated()) == false)
        {
            throw \Error::class;
        }

        return redirect('/admin/user');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userService->destroy($user);

        return redirect("/admin/user");
    }
}
