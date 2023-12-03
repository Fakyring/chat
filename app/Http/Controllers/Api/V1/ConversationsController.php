<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConversationRequest;
use App\Http\Resources\ConversationResource;
use App\Models\Conversations;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ConversationResource::collection(Conversations::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConversationRequest $convers)
    {
        $conv = Conversations::create($convers->validated());
        return $conv;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $convers = Conversations::where("id_convers", $id)->first();
        if (!$convers) {
            return response()->json(['data' => "No such conversation"], 404);
        }
        return ConversationResource::make($convers);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConversationRequest $request, Conversations $conversations)
    {
        $conversations->update($request->validated());
        return ConversationResource::make($conversations);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversations $conversations)
    {
        $conversations->delete();
        return response()->noContent();
    }
}
