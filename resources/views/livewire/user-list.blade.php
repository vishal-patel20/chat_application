<div class="flex flex-col gap-2">
    @forelse($users as $user)
        <a href="{{ route('chat', $user->id) }}"
            id="chat-user-{{ $user->id }}"
            class="flex items-center gap-3 bg-white hover:bg-green-50 active:scale-[0.98] border border-gray-100 px-4 py-3 rounded-2xl shadow-sm transition-all duration-150">
            
            {{-- Avatar & Online Status --}}
            <div class="relative flex items-center justify-center w-10 h-10 rounded-full bg-green-100 text-green-700 font-bold text-sm flex-shrink-0">
                {{ strtoupper(substr($user->name, 0, 1)) }}
                
                @if(in_array($user->id, $onlineUsers))
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white" title="Online"></div>
                @else
                    <div class="absolute bottom-0 right-0 w-3 h-3 bg-gray-300 rounded-full border-2 border-white" title="Offline"></div>
                @endif
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
