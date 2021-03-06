<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): Collection
    {
        return User::all();
    }

    public function show(int $id): User
    {
        return User::find($id);
    }

    public function store(Request $request) : Response
    {
        $user = User::create($request->only('first_name', 'last_name', 'email') + [
                'password' => Hash::make('12qwasZX')
            ]);

        return response($user, Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id) : Response
    {
        $user = User::find($id);

        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, Response::HTTP_ACCEPTED);
    }

    public function destroy(int $id) : Response
    {
        User::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
