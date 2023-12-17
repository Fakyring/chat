<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'Conversation' => $this->id_convers,
            'Creator' => $this->id_creator,
            'Name' => $this->name,
            'Description' => $this->description,
            'Private' => $this->private
        ];
    }
}
