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
            return response()->json(['data' => "No messages."], 404);
    }

    public function store(MessageRequest $request) {
        $message = Messages::create($request->validated());
        return $message;
    }

    public function show(string $id) {
        $message = Messages::where("id_user", $id)->where("deleted", 0)->get();
        if (!$message)
            return response()->json(['data' => "No such message."], 404);
        return $message;
    }

    public function update(MessageRequest $request, string $id) {
        $message = Messages::where("id_message", $id)->first();
        if (!$message)
            return response()->json(['data' => "No such message."], 404);
        if (!auth()->user() || auth()->user()->id_user !== $message->id_user)
            return response()->json(["data" => "You didn't write this message."], 403);
        $message->update($request->validated());
        return MessageResource::make($message);
    }

    public function destroy(string $id) {
        $message = Messages::where("id_message", $id)->first();
        if (!$message)
            return response()->json(['data' => "No such message."], 404);
        if (!auth()->user() || auth()->user()->id_user !== $message->id_user) {
            return response()->json(["data" => "You didn't write this message."], 403);
        }
        if ($message->deleted == 1)
            return response()->json(["data" => "Message is already deleted."]);
        $message->deleted = 1;
        $message->update();
        return $message;
    }
}
