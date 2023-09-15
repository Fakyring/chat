<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function MongoDB\BSON\toJSON;

class UsersController extends Controller {
    public function index() {
        return UserResource::collection(Users::all());
    }

    public function show($id) {
        $user = Users::where("id_user", $id)->first();
        if (!$user) {
            return response()->json(['data' => "No such user"], 404);
        }
        return UserResource::make($user);
    }

    public function store(UserRequest $user) {
        if (Users::where('login', $user['login'])->first()) {
            return response()->json(['data' => "User already exists"], 409);
        }
        $usr = Users::create($user->validated());
        return $usr;
    }

    public function update(UpdateUserRequest $request, Users $user) {
        $user->update($request->validated());
        return UserResource::make($user);
    }

    public function destroy(Users $user) {
        $user->delete();
        return response()->noContent();
    }
}
