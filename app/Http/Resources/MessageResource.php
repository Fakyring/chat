<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        if (auth()->user()->role === "1")
            return [
                'Id' => $this->id_message,
                'Sender' => $this->id_user,
                'Conversation' => $this->id_convers,
                'Text' => $this->text,
                'Deleted?' => $this->deleted ? "True" : "False"
            ];
        else
            return [
                'Id' => $this->id_message,
                'Sender' => $this->id_user,
                'Conversation' => $this->id_convers,
                'Text' => $this->text
            ];
    }
}
