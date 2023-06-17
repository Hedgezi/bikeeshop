<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Services\UserService;
use Illuminate\Http\Response;
use mysql_xdevapi\Exception;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
    )
    {

    }

    public function index(): View
    {
            return view('admin.users.index', [
                'users' => User::paginate(10)
            ]);
    }


    public function create()
    {
        return view('admin.users.form');
    }

    public function store(StoreUserRequest $request)
    {

        if ($this->userService->store($request->validated()) == false)
        {
            throw new Exception("Can't store new user", 502);
        }
        return redirect('/admin/user');
    }

    public function edit(User $user)
    {
        return view("admin.users.editform", [
            'user' => $user
        ]);
    }

    public function update(User $user, StoreUserRequest $request): RedirectResponse
    {
        if ($this->userService->update($user, $request->validated()) == false)
        {
            throw new Exception("Can't update user", 502);
        }

        return redirect('/admin/user');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userService->destroy($user);

        return redirect("/admin/user");
    }
}
