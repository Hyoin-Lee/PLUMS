<x-dashboard>
    <div class="mx-auto bg-white rounded-lg">
        <h2 class="text-xl font-semibold text-gray-800">Delete Quiz</h2>
        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <p class="text-lg text-gray-800 mb-2">Are you sure you want to delete this quiz? This action cannot be undone!</p>

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Quiz Title</label>
                <p id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $quiz["title"] ?? "" }}
                </p>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <p id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $quiz["description"] ?? "No description." }}
                </p>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Course</label>
                <p id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $quiz["course"]["title"] ?? "No assigned course." }}
                </p>
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Number of Questions</label>
                <p id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ count($quiz["questions"]) ?? "No assigned questions." }}
                </p>
            </div>

            <div class="flex flex-row items-center justify-center gap-2">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Delete Quiz</button>
                <a href="{{ route('quizzes.index') }}" class="block bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
            </div>
        </form>
    </div>
</x-dashboard>
