<x-dashboard>
    <h1 class="text-xl font-semibold mb-2">Edit Quiz</h1>

    <form action="{{ route('quizzes.update', $quiz->id) }}" class="mb-4" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $quiz->title) }}"
                placeholder="Enter Quiz Title"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                required>
        </div>

        <div class="mb-2">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea
                name="description"
                id="description"
                placeholder="Enter Quiz Description"
                class="form-textarea mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                required>{{ old('description', $quiz->description) }}</textarea>
        </div>

        <div class="mb-2">
            <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
            <select
                name="course_id"
                id="course_id"
                class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
            >
                <option value="">None</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label for="time_limit" class="block text-sm font-medium text-gray-700">Time Limit (minutes)</label>
            <input
                type="number"
                name="time_limit"
                id="time_limit"
                value="{{ old('time_limit', $quiz->time_limit) }}"
                placeholder="Enter Time Limit"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3">
        </div>

        <div class="flex items-center justify-center gap-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Update Quiz</button>
            <a href="{{ route('quizzes.index') }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
        </div>
    </form>

    <h1 class="text-xl font-semibold mb-2">Questions</h1>

    <form action="{{ route('quiz-questions.store') }}" class="mb-4" method="POST">
        @csrf
        <input type="number" name="quiz_id" id="quiz_id" value="{{ $quiz->id }}" class="hidden">

        <div class="mb-2">
            <label for="question_id" class="block text-sm font-medium text-gray-700">Select Question</label>
            <select
                name="question_id"
                id="question_id"
                class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                required>
                @foreach($questions as $question)
                    @if($question->course_id == $quiz->course_id)
                        <option value="{{ $question->id }}">{{ $question->question }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-center gap-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Add Question</button>
        </div>
    </form>

    <table class="min-w-full bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-300">
        <thead class="bg-purple-600 text-white">
        <tr>
            <th class="py-2 px-4 text-center border-b border-gray-300">Question</th>
            <th class="py-2 px-4 text-center border-b border-gray-300">Actions</th>
        </tr>
        </thead>

        <tbody class="bg-white divide-y divide-gray-200 text-center">
        @foreach($quiz->quizQuestions as $quizQuestion)
            <tr>
                <td class="py-2 px-4 text-center border-b border-gray-200">{{ $quizQuestion->question->question }}</td>
                <td class="py-2 px-4 text-center border-b border-gray-200">
                    <div class="flex justify-center space-x-2">
                        <form action="{{ route('quiz-questions.delete', $quizQuestion) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded-md transition duration-200">Remove</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
        <tr>
            <td colspan="2" class="py-2 px-4 bg-gray-100 border-t border-gray-300 text-center"></td>
        </tr>
        </tfoot>
    </table>
</x-dashboard>
