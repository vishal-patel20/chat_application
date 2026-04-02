<?php

namespace App\Livewire;

use App\Models\msg;
use Livewire\Component;
use App\Models\User;

class ChatComponent extends Component
{
    public $user_id;
    public $user;
    public $sender_id;
    public $receiver_id;
    public $message = "";
    public $messages = [];

    public function mount($user_id)
    {
        $this->sender_id   = auth()->user()->id;
        $this->receiver_id = $user_id;
        $this->user        = User::find($user_id);   // Bug 3 fixed: single fetch

        $messages = msg::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                  ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                  ->where('receiver_id', $this->sender_id);
        })
        ->with('sender:id,name', 'receiver:id,name')
        ->orderBy('created_at', 'asc')
        ->get();

        foreach ($messages as $message) {
            $this->appendChatMessage($message);
        }
    }

    public function render()
    {
        return view('livewire.chat-component');
    }

    public function sendmessage()
    {
        $this->validate(['message' => 'required|string|max:1000']);

        $chatMessage = msg::create([
            'sender_id'   => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'message'     => $this->message,
        ]);

        // Bug 2 fixed: load relationships then append so the UI updates instantly
        $chatMessage->load('sender:id,name', 'receiver:id,name');
        $this->appendChatMessage($chatMessage);

        $this->message = '';
    }

    public function appendChatMessage($message)
    {
        $this->messages[] = [
            'id'        => $message->id,
            'message'   => $message->message,
            'sender_id' => $message->sender_id,           // Bug 1 fixed: store ID not name
            'sender'    => $message->sender->name,
            'receiver'  => $message->receiver->name,
        ];
    }
}