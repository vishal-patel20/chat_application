<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-4">

        {{-- Group Chat Banner --}}
        <a href="{{ route('group-chat') }}"
            id="group-chat-btn"
            class="flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white px-5 py-4 rounded-2xl shadow-md transition-all duration-150">
            <div class="flex items-center justify-center w-10 h-10 bg-white/20 rounded-full flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                </svg>
            </div>
            <div>
                <p class="font-semibold text-base leading-tight">🌐 Group Chat</p>
                <p class="text-xs text-indigo-200">Everyone in the app</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white/60 ml-auto" viewBox="0 0 24 24">
                <path fill="currentColor" d="M9.29 6.71a1 1 0 0 0 0 1.41L13.17 12l-3.88 3.88a1 1 0 1 0 1.41 1.41l4.59-4.59a1 1 0 0 0 0-1.41L10.7 6.7a1 1 0 0 0-1.41.01z"/>
            </svg>
        </a>

        {{-- Section label --}}
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-1">Direct Messages</p>

        {{-- User list --}}
        <div class="flex flex-col gap-2">
            @forelse($users as $user)
                <a href="{{ route('chat', $user->id) }}"
                    id="chat-user-{{ $user->id }}"
                    class="flex items-center gap-3 bg-white hover:bg-green-50 active:scale-[0.98] border border-gray-100 px-4 py-3 rounded-2xl shadow-sm transition-all duration-150">
                    {{-- Avatar --}}
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-100 text-green-700 font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-800 truncate">{{ $user->name }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-300" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M9.29 6.71a1 1 0 0 0 0 1.41L13.17 12l-3.88 3.88a1 1 0 1 0 1.41 1.41l4.59-4.59a1 1 0 0 0 0-1.41L10.7 6.7a1 1 0 0 0-1.41.01z"/>
                    </svg>
                </a>
            @empty
                <p class="text-sm text-gray-400 text-center py-6">No other users found.</p>
            @endforelse
        </div>

    </div>
</x-layouts::app>
