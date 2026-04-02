<?php

namespace App\Livewire;

use App\Models\msg;
use App\Models\User;
use Livewire\Component;

class GroupChatComponent extends Component
{
    public $message = '';
    public $messages = [];
    public $sender_id;

    public function mount()
    {
        $this->sender_id = auth()->id();

        $msgs = msg::where('is_group', true)
            ->with('sender:id,name')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($msgs as $m) {
            $this->appendChatMessage($m);
        }
    }

    public function render()
    {
        return view('livewire.group-chat-component');
    }

    public function sendmessage()
    {
        $this->validate(['message' => 'required|string|max:1000']);

        $chatMessage = msg::create([
            'sender_id'   => $this->sender_id,
            'receiver_id' => null,
            'message'     => $this->message,
            'is_group'    => true,
        ]);

        $chatMessage->load('sender:id,name');
        $this->appendChatMessage($chatMessage);

        $this->message = '';
    }

    public function appendChatMessage($message)
    {
        $this->messages[] = [
            'id'         => $message->id,
            'message'    => $message->message,
            'sender_id'  => $message->sender_id,
            'sender'     => $message->sender->name,
            'created_at' => $message->created_at
                ? $message->created_at->format('H:i')
                : now()->format('H:i'),
        ];
    }
}
