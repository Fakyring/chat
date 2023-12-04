<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationRequest;
use App\Http\Resources\ConversationResource;
use App\Models\Conversations;

class ConversationsController extends Controller
{
    public function index() {
        $convers = ConversationResource::collection(Conversations::all());
        if ($convers->count() > 0)
            return $convers;
        else
            return response()->json(['data' => "No conversations"], 404);
    }

    public function store(ConversationRequest $convers) {
        $conv = Conversations::create($convers->validated());
        return $conv;
    }

    public function show($id) {
        $convers = Conversations::where("id_convers", $id)->first();
        if (!$convers) {
            return response()->json(['data' => "No such conversation"], 404);
        }
        return ConversationResource::make($convers);
    }

    public function update(ConversationRequest $request, $id) {
        $convers = Conversations::where("id_convers", $id)->first();
        $convers->update($request->validated());
        return ConversationResource::make($convers);
    }

    public function destroy($id) {
        $convers = Conversations::where("id_convers", $id)->first();
        $convers->delete();
        return response()->noContent();
    }
}
