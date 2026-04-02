<div class="fixed inset-0 z-50 flex flex-col bg-gray-100 overflow-x-hidden">

    <!-- HEADER -->
    <div class="fixed top-0 w-full bg-green-500 h-14 flex items-center justify-between px-4 text-white shadow-md z-10">

        <!-- Back button -->
        <a href="/dashboard" class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-green-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24">
                <path fill="currentColor" d="M9.41 11H17a1 1 0 0 1 0 2H9.41l2.3 2.3a1 1 0 1 1-1.42 1.4l-4-4a1 1 0 0 1 0-1.4l4-4a1 1 0 0 1 1.42 1.4L9.4 11z"/>
            </svg>
        </a>

        <!-- Chat partner name -->
        <div class="flex flex-col items-center">
            <span class="font-semibold text-base tracking-wide">{{ $user->name }}</span>
            <span class="text-xs text-green-100 opacity-80">Personal Chat</span>
        </div>

        <!-- Menu dots -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white opacity-70" viewBox="0 0 24 24">
            <path fill="currentColor" d="M12 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
        </svg>
    </div>

    <!-- CHAT BODY -->
    <div class="flex-1 overflow-y-auto pt-20 pb-24 px-3 space-y-2">

        @forelse($messages as $message)

            {{-- Bug 1 FIXED: compare sender_id (integer) with auth()->id() (integer) --}}
            @if($message['sender_id'] == auth()->id())
                <!-- Sent (right side) -->
                <div class="flex justify-end">
                    <div class="bg-green-500 text-white px-4 py-2 rounded-2xl rounded-br-sm max-w-xs shadow-sm">
                        <p class="text-sm">{{ $message['message'] }}</p>
                    </div>
                </div>
            @else
                <!-- Received (left side) -->
                <div class="flex flex-col items-start">
                    <span class="text-xs text-gray-500 ml-1 mb-0.5">{{ $message['sender'] }}</span>
                    <div class="bg-white text-gray-800 px-4 py-2 rounded-2xl rounded-bl-sm max-w-xs shadow-sm">
                        <p class="text-sm">{{ $message['message'] }}</p>
                    </div>
                </div>
            @endif

        @empty
            <div class="flex items-center justify-center h-full pt-20">
                <p class="text-gray-400 text-sm">No messages yet. Say hello! 👋</p>
            </div>
        @endforelse

    </div>
    {{-- Bug 4 FIXED: form is OUTSIDE the chat body div --}}

    <!-- BOTTOM BAR -->
    <form wire:submit.prevent="sendmessage" class="fixed bottom-0 w-full z-10">
        <div class="flex items-center bg-white border-t border-gray-200 px-3 py-3 gap-2">

            <!-- Input pill -->
            <input
                type="text"
                id="message-input"
                class="flex-1 bg-gray-100 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-400 px-5 py-3 rounded-full transition"
                wire:model="message"
                placeholder="Type a message..."
                autocomplete="off"
            />

            <!-- Send button -->
            <button type="submit" id="send-btn"
                class="flex items-center justify-center w-11 h-11 bg-green-500 hover:bg-green-600 active:scale-95 rounded-full flex-shrink-0 transition-all duration-150 shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z"/>
                </svg>
            </button>

        </div>
    </form>

</div>