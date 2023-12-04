<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Messages;

class MessagesController extends Controller {
    public function index() {
        $messages = MessageResource::collection(Messages::all()->where("deleted", 0));
        if ($messages->count() > 0)
            return $messages;
        else
            return response()->json(['data' => "No messages"], 404);
    }

    public function store(MessageRequest $request) {
        $message = Messages::create($request->validated());
        return $message;
    }

    public function show(string $id) {
        $messages = Messages::where("id_user", $id)->where("deleted", 0)->get();
        if (!$messages) {
            return response()->json(['data' => "No such message"], 404);
        }
        return $messages;
    }

    public function update(MessageRequest $request, string $id) {
        $message = Messages::where("id_message", $id)->first();
        $message->update($request->validated());
        return MessageResource::make($message);
    }

    public function destroy(string $id) {
        $message = Messages::where("id_message", $id)->first();
        $message->deleted = 1;
        $message->update();
        return $message;
    }
}
