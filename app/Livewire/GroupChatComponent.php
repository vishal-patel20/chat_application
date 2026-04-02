<?php

namespace App\Livewire;

use App\Models\msg;
use App\Models\User;
use Livewire\Component;
use App\Events\GroupMessageSent;

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

    public function getListeners()
    {
        return [
            "echo-presence:group.chat,GroupMessageSent" => 'receiveMessage',
        ];
    }

    public function receiveMessage($event)
    {
        if ($event['senderId'] != $this->sender_id) {
            $message = msg::find($event['messageId']);
            if ($message) {
                $message->load('sender:id,name');
                $this->appendChatMessage($message);
            }
        }
    }

    public function sendmessage()
    {
        $this->validate(['message' => 'required|string|max:1000']);

        $chatMessage = msg::create([
            'sender_id'   => $this->sender_id,
            'receiver_id' => 0, // Using 0 because SQLite migration didn't make this nullable
            'message'     => $this->message,
            'is_group'    => true,
        ]);

        $chatMessage->load('sender:id,name');
        $this->appendChatMessage($chatMessage);

        try {
            broadcast(new GroupMessageSent($chatMessage->id, $this->sender_id));
        } catch (\Exception $e) {
            // Ignore broadcast exception if Reverb server is down
        }

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
