<x-dashboard>
    <div class="mx-auto bg-white rounded-lg">
        <h2 class="text-xl font-semibold text-gray-800">Delete Question</h2>
        <form action="{{ route('questions.destroy', $question->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <p class="text-lg text-gray-800">Are you sure you want to delete this question? This action cannot be undone!</p>
            <p class="text-lg text-gray-800 mb-2">Please note you cannot delete a question if one or more answers are assigned to it.</p>

            <div class="mb-4">
                <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                <p id="question" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $question["question"] ?? "No question text." }}
                </p>
            </div>

            <div class="mb-4">
                <label for="course_name" class="block text-sm font-medium text-gray-700">Course</label>
                <p id="course_name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $question["course"]["title"] ?? "No course." }}
                </p>
            </div>

            <div class="mb-4">
                <label for="cert_level" class="block text-sm font-medium text-gray-700">Certificate Level</label>
                <p id="cert_level" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $question["certificate"]["level"] ?? "No certificate level." }}
                </p>
            </div>

            <div class="mb-4">
                <label for="score" class="block text-sm font-medium text-gray-700">Score</label>
                <p id="score" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $question["score"] ?? "No score." }}
                </p>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Answers</label>
                <p id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ count($question["answers"]) ?? "No description." }}
                </p>
            </div>

            <div class="flex flex-row items-center justify-center gap-2">
                @if(count($question["answers"]) === 0)
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Delete Question</button>
                @endif
                <a href="{{ route('questions.index') }}" class="block bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
            </div>
        </form>
    </div>
</x-dashboard>
