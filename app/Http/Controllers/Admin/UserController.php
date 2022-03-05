<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $params = [];
        $query = User::query();

        $params['per_page'] = $request->input('per_page', 10);
        $users = $query->paginate($params['per_page'])->appends($params);
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->nickname = $request->input('nickname');
        $user->email = $request->input('email');
        $user->avatar = $request->input('avatar');
        $user->admin = (bool) $request->input('admin');
        $user->save();
        return response()->redirectToRoute('admin.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->redirectToRoute('admin.users.index')->with('successMessage', 'The user has been deleted');
    }
}
