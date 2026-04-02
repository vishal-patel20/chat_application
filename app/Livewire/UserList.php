<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $users = [];
    public $onlineUsers = [];

    public function mount()
    {
        $this->users = User::where('id', '!=', auth()->id())->get();
    }

    public function getListeners()
    {
        return [
            "echo-presence:online,here" => 'setOnlineUsers',
            "echo-presence:online,joining" => 'userJoined',
            "echo-presence:online,leaving" => 'userLeft',
        ];
    }

    public function setOnlineUsers($users)
    {
        $this->onlineUsers = collect($users)->pluck('id')->toArray();
    }

    public function userJoined($user)
    {
        if (!in_array($user['id'], $this->onlineUsers)) {
            $this->onlineUsers[] = $user['id'];
        }
    }

    public function userLeft($user)
    {
        $this->onlineUsers = array_filter($this->onlineUsers, function ($id) use ($user) {
            return $id != $user['id'];
        });
    }

    public function render()
    {
        return view('livewire.user-list');
    }
}
