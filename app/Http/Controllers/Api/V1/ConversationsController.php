<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationRequest;
use App\Http\Resources\ConversationResource;
use App\Models\Conversations;
use App\Models\UserConvers;

class ConversationsController extends Controller {
    public function index() {
        $convers = ConversationResource::collection(Conversations::all());
        if ($convers->count() > 0)
            return $convers;
        else
            return response()->json(['data' => "Нет бесед"], 404);
    }

    public function store(ConversationRequest $convers) {
        $conv = Conversations::create($convers->validated() + ["id_creator"=>auth()->id()]);
        UserConvers::create(["id_user"=>$conv->id_creator, "id_conver"=>$conv->id_convers]);
        return $convers;
    }

    public function show($id) {
        $convers = Conversations::where("id_convers", $id)->first();
        if (!$convers) {
            return response()->json(['data' => "Нет такой беседы"], 404);
        }
        return ConversationResource::make($convers);
    }

    public function update(ConversationRequest $request, $id) {
        $convers = Conversations::where("id_convers", $id)->first();
        if (!$convers)
            return response()->json(["data" => "Нет такой беседы"], 404);
        if (!auth()->user() || (auth()->user()->id_user != $convers->id_creator && auth()->user()->role != 1)) {
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        }
        $convers->update($request->validated());
        return ConversationResource::make($convers);
    }

    public function destroy($id) {
        $convers = Conversations::where("id_convers", $id)->first();
        if (!$convers)
            return response()->json(["data" => "Нет такой беседы"], 404);
        if (!auth()->user() || (auth()->user()->id_user !== $convers->id_creator && auth()->user()->role != 1)) {
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        }
        $convers->delete();
        return response()->noContent();
    }
}
