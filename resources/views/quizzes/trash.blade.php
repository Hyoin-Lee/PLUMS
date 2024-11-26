<x-dashboard>
    <div class="py-6">
        <h1 class="text-3xl font-bold text-center text-purple-800 mb-6">Trashed Quizzes</h1>

        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('quizzes.index') }}"
               class="bg-purple-500 text-white p-2 rounded hover:bg-purple-800 duration-300 ease-in-out transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
{{ __('Back to Quizzes') }}
</a>
</div>

<!-- Trashed Quizzes Table -->
<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Level</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deleted At</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
        </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200">
        @foreach($trashedQuizzes as $quiz)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quiz->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quiz->level }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quiz->deleted_at->format('Y-m-d H:i:s') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 flex flex-col gap-2">
                    <!-- Restore Form -->
                    <form action="{{ route('quizzes.trash-restore', $quiz->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-1 px-3 rounded-md transition duration-300">Restore</button>
                    </form>
                    <!-- Force Delete Form -->
                    <form action="{{ route('quizzes.trash-remove', $quiz->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded-md transition duration-300">Permanently Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</div>
</x-dashboard>
