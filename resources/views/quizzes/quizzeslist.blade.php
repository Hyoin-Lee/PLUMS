<x-dashboard>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-3xl font-bold text-center text-purple-800 mb-6">Quizzes List</h1>


                <!-- Back Button -->
                <div class="mb-4 flex justify-between items-center">
                    <a href="{{ route('quizzeslist') }}" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Quiz List</a>
                    <button onclick="window.location.href='http://plums.test/quizzes'"
                            class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Quizzes
                    </button>

                <!-- Trash Button with Count -->
                    <button class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 6h14M3 9v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9m-9-4V2m4 0v3m-8 0v3m4 0v3m4 0v3" />
                        </svg>
                        Quizzes Deleted: <span class="font-bold">0</span>
                    </button>
                </div>

                <!-- Quizzes Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
{{--                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>--}}
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Questions</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($quizzes as $quiz)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quiz->id }}</td>
{{--                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $quiz->title }}</td>--}}
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @foreach ($quiz->questions as $question)
                                        <div>{{ $question->question_text }}</div>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <!-- Action buttons -->
                                    <a href="{{ route('quizzes.edit', $quiz->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded-md transition duration-300">Edit</a>
                                    <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this quiz?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded-md transition duration-300">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
