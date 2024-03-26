<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('register');
    }

    public function store(RegisterUserRequest $request) {
        $validated = $request->validated();

        $name = $validated['first-name'] . " ";
        $name .= $validated['infix'] ? $validated['infix'] . ' ' : '';
        $name .= $validated['last-name'];
        $apitoken = Str::random(80);

        $user = User::create([
            'email' => $validated['email'],
            'name' => $name,
            'password' => bcrypt($validated['password']),
            'api_token' => $apitoken,
        ]);

        if(isset($validated["place-ads"]) && $validated['place-ads'] == "on") {
            $role = Role::all()->where('name', $validated['account-type'])->first();

            $roleId = $role->id;
            $userId = $user->id;

            $user->roles()->attach($roleId, ['user_id' => $userId, 'role_id' => $roleId]);
        }

        Auth()->login($user);
    }
}
