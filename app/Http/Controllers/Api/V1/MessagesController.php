<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Conversations;
use App\Models\Messages;
use App\Models\UserConvers;

class MessagesController extends Controller {
    public function index() {
        if (auth()->user()->role === 1)
            $messages = MessageResource::collection(Messages::all());
        else
            $messages = MessageResource::collection(Messages::all()->where("deleted", 0));
        if ($messages->count() > 0)
            return $messages;
        else
            return response()->json(['data' => "Нет сообщений"], 404);
    }

    public function store(MessageRequest $request) {
        $userConver = UserConvers::where("id_user", auth()->id())->where("id_conver", $request->id_convers);
        $conver = Conversations::where("id_convers", $request->id_convers)->first();
        if (auth()->user() && (auth()->user()->role === 1 || $userConver->count() != 0 || $conver->private === 0))
            $message = Messages::create($request->validated() + ["id_user" => auth()->id()]);
        else
            return response()->json(['data' => "Нет прав"], 404);
        return $message;
    }

    public function show(string $id) {
        $message = Messages::where("id_user", $id)->where("deleted", 0)->get();
        if ($message->count() == 0)
            return response()->json(['data' => "Нет сообщений"], 404);
        return $message;
    }

    public function update(MessageRequest $request, string $id) {
        $message = Messages::where("id_message", $id)->first();
        if (!$message)
            return response()->json(['data' => "Нет такого сообщения"], 404);
        if (!auth()->user() || (auth()->user()->id_user !== $message->id_user && auth()->user()->role != 1))
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        $message->update($request->validated());
        return MessageResource::make($message);
    }

    public function destroy(string $id) {
        $message = Messages::where("id_message", $id)->first();
        if (!$message)
            return response()->json(['data' => "Нет такого сообщения"], 404);
        if (!auth()->user() || (auth()->user()->id_user !== $message->id_user && auth()->user()->role != 1)) {
            return response()->json(["data" => "У вас недостаточно прав"], 403);
        }
        if ($message->deleted == 1)
            return response()->json(["data" => "Сообщение уже удалено"]);
        $message->deleted = 1;
        $message->update();
        return $message;
    }
}
