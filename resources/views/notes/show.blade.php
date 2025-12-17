<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $note->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('notes.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mb-4 inline-block">
                    ← Back to Notes
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 lg:p-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-4">
                                <span class="px-2 py-1 bg-gray-200 dark:bg-gray-700 rounded">{{ $note->folder }}</span>
                                <span>Created: {{ $note->created_at->format('M d, Y g:i A') }}</span>
                                @if($note->updated_at != $note->created_at)
                                    <span>Updated: {{ $note->updated_at->format('M d, Y g:i A') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center gap-2 ml-4">
                            <a href="{{ route('notes.edit', $note) }}" class="px-3 py-1 text-sm border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
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

                    <div class="prose dark:prose-invert max-w-none">
                        <div class="whitespace-pre-wrap text-gray-900 dark:text-gray-100 leading-relaxed">
                            {{ $note->content }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
