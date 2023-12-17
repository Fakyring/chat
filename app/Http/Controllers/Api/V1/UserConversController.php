<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserConversRequest;
use App\Http\Resources\UserConversResource;
use App\Models\UserConvers;
use Illuminate\Http\Request;

class UserConversController extends Controller {
    public function store(UserConversRequest $request) {
        $userConver = UserConvers::where("id_user", auth()->id())->where("id_conver", $request->id_conver)->first();
        if (auth()->user()->role === 1 || $userConver) {
            $newUserConver = UserConvers::create($request->validated());
            return UserConversResource::make($newUserConver);
        } else {
            return response()->json(['data' => "Нет прав"], 404);
        }
    }

    public function show(string $id) {
        $userConver = UserConvers::where("id_conver", $id)->get();
        if ($userConver->count() > 0)
            if (auth()->user()->role === 1 || $userConver[0]->id_user == auth()->id())
                return $userConver;
            else
                return response()->json(['data' => "Нет прав"], 404);
    }

    public function destroy(string $id) {
        if (auth()->user()->role === 1)
            $userConver = UserConvers::where("id_user_convers", $id)->first();
        else
            $userConver = UserConvers::where("id_user_convers", $id)->where("id_user", auth()->id())->first();
        if ($userConver) {
            $userConver->delete();
            return response()->json(['data' => "Приглашение удалено"]);
        }
        return response()->json(['data' => "Нет такого пользователя в беседе или нет прав"], 404);
    }
}
