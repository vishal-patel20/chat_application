<div class="fixed inset-0 z-50 flex flex-col bg-gray-100 overflow-x-hidden">

    <!-- HEADER -->
    <div class="fixed top-0 w-full bg-indigo-600 h-14 flex items-center justify-between px-4 text-white shadow-md z-10">

        <!-- Back button -->
        <a href="/dashboard" class="flex items-center justify-center w-8 h-8 rounded-full hover:bg-indigo-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24">
                <path fill="currentColor" d="M9.41 11H17a1 1 0 0 1 0 2H9.41l2.3 2.3a1 1 0 1 1-1.42 1.4l-4-4a1 1 0 0 1 0-1.4l4-4a1 1 0 0 1 1.42 1.4L9.4 11z"/>
            </svg>
        </a>

        <!-- Title -->
        <div class="flex flex-col items-center">
            <span class="font-bold text-base tracking-wide">🌐 Group Chat</span>
            <span class="text-xs text-indigo-200">Everyone</span>
        </div>

        <!-- People icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white opacity-80" viewBox="0 0 24 24">
            <path fill="currentColor" d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
        </svg>
    </div>

    <!-- CHAT BODY -->
    <div class="flex-1 overflow-y-auto pt-20 pb-24 px-3 space-y-3">

        @forelse($messages as $message)

            @if($message['sender_id'] == auth()->id())
                <!-- Sent (right side) -->
                <div class="flex justify-end">
                    <div class="flex flex-col items-end">
                        <div class="bg-indigo-500 text-white px-4 py-2 rounded-2xl rounded-br-sm max-w-xs shadow-sm">
                            <p class="text-sm">{{ $message['message'] }}</p>
                        </div>
                        <span class="text-xs text-gray-400 mt-0.5 mr-1">{{ $message['created_at'] }}</span>
                    </div>
                </div>
            @else
                <!-- Received (left side) -->
                <div class="flex flex-col items-start">
                    <span class="text-xs font-semibold text-indigo-600 ml-1 mb-0.5">{{ $message['sender'] }}</span>
                    <div class="bg-white text-gray-800 px-4 py-2 rounded-2xl rounded-bl-sm max-w-xs shadow-sm">
                        <p class="text-sm">{{ $message['message'] }}</p>
                    </div>
                    <span class="text-xs text-gray-400 mt-0.5 ml-1">{{ $message['created_at'] }}</span>
                </div>
            @endif

        @empty
            <div class="flex flex-col items-center justify-center pt-20 gap-2">
                <div class="text-5xl">💬</div>
                <p class="text-gray-400 text-sm">No messages yet. Be the first to say hello!</p>
            </div>
        @endforelse

    </div>

    <!-- BOTTOM BAR -->
    <form wire:submit.prevent="sendmessage" class="fixed bottom-0 w-full z-10">
        <div class="flex items-center bg-white border-t border-gray-200 px-3 py-3 gap-2">

            <!-- Input pill -->
            <input
                type="text"
                id="group-message-input"
                class="flex-1 bg-gray-100 text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-400 px-5 py-3 rounded-full transition"
                wire:model="message"
                placeholder="Message everyone..."
                autocomplete="off"
            />

            <!-- Send button -->
            <button type="submit" id="group-send-btn"
                class="flex items-center justify-center w-11 h-11 bg-indigo-600 hover:bg-indigo-700 active:scale-95 rounded-full flex-shrink-0 transition-all duration-150 shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" viewBox="0 0 512 512">
                    <path fill="currentColor" d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z"/>
                </svg>
            </button>

        </div>
    </form>

</div>
