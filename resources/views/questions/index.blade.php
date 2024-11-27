<x-dashboard>
    <div class="container mx-auto p-6 bg-white">
        <h1 class="text-3xl font-bold text-center text-purple-800 mb-6">Questions List</h1>

        <section class="flex justify-between items-center mb-4">
            <a href="{{ route('questions.create') }}"
                class="bg-purple-500 text-white p-2 rounded hover:bg-purple-800
                        duration-300 ease-in-out transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('New Question') }}
            </a>
        </section>

        <section class="flex justify-between items-center mb-4">
            <form action="{{ route('questions.index') }}" method="GET" class="w-full">
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by question name"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-purple-500 transition duration-200">
            </form>
        </section>

        <!-- Questions Table -->
        <table class="min-w-full bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-300">
            <thead class="bg-purple-500 text-white">
            <tr class="w-full">
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Question</th>
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Answer</th>
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Actions</th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 text-center">
            @foreach($questions as $question)
                <tr>
                    <td class="py-2 px-4 text-center border-b border-gray-200">{{ $question['question'] }}</td>
                    <td class="py-2 px-4 text-center border-b border-gray-200">
                        @php
                            $correctAnswer = $question->answers->firstWhere('correct', true);
                        @endphp

                        @if($correctAnswer)
                            {{ $correctAnswer->answer}}
                        @else
                            <span class="text-red-600">This question has no correct answer.</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 text-center border-b border-gray-200">
                        <div class="flex justify-center space-x-2">
                            <form action="{{ route('questions.edit', $question) }}" method="GET">
                                @csrf
                                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-1 px-3 rounded-md transition duration-200">Edit</button>
                            </form>
                            <form action="{{ route('questions.delete', $question) }}" method="GET">
                                @csrf
                                <button class="w-full bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded-md transition duration-200">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr class="w-full">
                <td colspan="4" class="py-2 px-4 bg-gray-100 border-t border-gray-300 text-center">
                    @if($questions->hasPages())
                        {{ $questions->links() }}
                    @else
                        <small>No pages.</small>
                    @endif
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</x-dashboard>
