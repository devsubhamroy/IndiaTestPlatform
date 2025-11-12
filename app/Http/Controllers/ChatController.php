<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index() {
        return response()->json(Chat::with(['sender', 'receiver'])->latest()->get());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'message' => 'nullable|string',
            'attachment' => 'nullable|string'
        ]);

        $chat = Chat::create($data);
        return response()->json($chat, 201);
    }

    public function show(Chat $chat) {
        return response()->json($chat->load(['sender', 'receiver']));
    }

    public function destroy(Chat $chat) {
        $chat->delete();
        return response()->json(['message' => 'Chat deleted successfully']);
    }
}
