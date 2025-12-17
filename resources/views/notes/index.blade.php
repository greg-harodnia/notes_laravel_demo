<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-200 dark:text-gray-800 leading-tight">
                My Notes
            </h2>
            <a href="{{ route('notes.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                Create Note
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($notes->count() > 0)
                <div class="space-y-4">
                    @foreach($notes as $note)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-semibold mb-2">
                                            <a href="{{ route('notes.show', $note) }}" class="hover:underline text-gray-900 dark:text-gray-200">
                                                {{ $note->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-600 dark:text-gray-400 mb-3 line-clamp-2">
                                            {{ Str::limit($note->content, 150) }}
                                        </p>
                                        <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded">{{ $note->folder }}</span>
                                            <span>{{ $note->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 ml-4">
                                        <a href="{{ route('notes.edit', $note) }}" class="px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-200 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                            Edit
                                        </a>
                                        <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this note?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 text-sm border border-red-300 dark:border-red-800 text-red-600 dark:text-red-400 rounded-md hover:bg-red-50 dark:hover:bg-red-900 transition-colors">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $notes->links() }}
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <p class="text-gray-600 dark:text-gray-400 mb-4">No notes yet.</p>
                        <a href="{{ route('notes.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Create your first note
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
