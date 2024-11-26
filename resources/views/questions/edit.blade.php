<x-dashboard>
{{--    <div class="container mx-auto p-6 bg-white">--}}
        <h1 class="text-xl font-semibold mb-2">Edit Question</h1>

        <form action="{{ route('questions.update', $question->id) }}" class="mb-4" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Question</label>
                <input
                    type="text"
                    name="question"
                    id="question"
                    value="{{ old('name', $question->question) }}"
                    placeholder="Enter Question Text"
                    class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                    required>
            </div>

            <div class="mb-2">
                <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                <select
                    name="course_id"
                    id="course_id"
                    class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                >
                    <option value="">None</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $question->course_id == $course->id? 'selected' : '' }}>{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-2">
                <label for="certificate_id" class="block text-sm font-medium text-gray-700">Certificate Level</label>
                <select
                    name="certificate_id"
                    id="certificate_id"
                    class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                >
                    @foreach($certificates as $certificate)
                        <option value="{{ $certificate->id }}" {{ $question->certificate_id == $certificate->id? 'selected' : '' }}>{{ $certificate->cert_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label for="score" class="block text-sm font-medium text-gray-700">Score</label>
                <select
                    name="score"
                    id="score"
                    class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                    required
                >
                    @for ($i = $question->certificate->level; $i <= $question->certificate->level + 4; $i++)
                        <option value="{{ $i }}" {{ $i == $question->score ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="flex items-center justify-center gap-2">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Update Question</button>
                <a href="{{ route('questions.index') }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
            </div>
        </form>

        <h1 class="text-xl font-semibold mb-2">Question Tags</h1>

        <form action="{{ route('questions.updateTags', $question->id) }}" method="POST" class="mb-4">
            @csrf
            @method('PUT')

            <div id="tags" class="p-3 border border-gray-300 rounded-md shadow-sm bg-gray-100 max-h-40 overflow-y-auto">
                @foreach($allTags as $tag)
                    <div class="flex items-center mb-2">
                        <input
                            type="checkbox"
                            name="tags[]"
                            id="tag-{{ $tag->id }}"
                            value="{{ $tag->id }}"
                            class="form-checkbox h-5 w-5 text-purple-600 focus:ring focus:ring-purple-500 focus:ring-opacity-50 checked:bg-purple-500 checked:border-transparent"
                            {{ in_array($tag->id, $questionTags->pluck('id')->toArray()) ? 'checked' : '' }}
                        >
                        <label for="tag-{{ $tag->id }}" class="ml-2 text-sm text-gray-700">{{ $tag->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-center gap-2 mt-2">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Update Tags</button>
            </div>
        </form>

        <h1 class="text-xl font-semibold mb-2">Answers</h1>

        <form action="{{ route('answers.store') }}" class="mb-4" method="POST">
            @csrf
            @method('POST')

            <input type="number" name="question_id" id="question_id" value="{{ $question->id }}" class="hidden">

            <div class="mb-2">
                <label for="answer" class="block text-sm font-medium text-gray-700">Answer</label>
                <input
                    type="text"
                    name="answer"
                    id="answer"
                    placeholder="Enter Answer Text"
                    class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"
                    required>
            </div>

            <div class="mb-4">
                <label for="correct" class="block text-sm font-medium text-gray-700">Correct Answer</label>
                <select
                    id="correct"
                    name="correct"
                    class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                    <option value="1">Yes</option>
                    <option value="0" selected>No</option>
                </select>
            </div>

            <div class="flex items-center justify-center gap-2">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Create Answer</button>
            </div>
        </form>

        <table class="min-w-full bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-300">
            <thead class="bg-purple-600 text-white">
            <tr>
                <th class="py-2 px-4 text-center border-b border-gray-300">Answer</th>
                <th class="py-2 px-4 text-center border-b border-gray-300">Correct</th>
                <th class="py-2 px-4 text-center border-b border-gray-300">Actions</th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 text-center">
            @foreach($question['answers'] as $answer)
                <tr>
                    <td class="py-2 px-4 text-center border-b border-gray-200">{{ $answer['answer'] }}</td>
                    <td class="py-2 px-4 text-center border-b border-gray-200">
                        {{ $answer['correct'] ? "Yes" : "No" }}
                    </td>
                    <td class="py-2 px-4 text-center border-b border-gray-200">
                        <div class="flex justify-center space-x-2">
                            <form action="{{ route('answers.edit', $answer) }}" method="GET">
                                @csrf
                                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-1 px-3 rounded-md transition duration-200">Edit</button>
                            </form>
                            <form action="{{ route('questions.delete', $answer) }}" method="GET">
                                @csrf
                                <button class="w-full bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded-md transition duration-200">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

            <tfoot>
            <tr>
                <td colspan="3" class="py-2 px-4 bg-gray-100 border-t border-gray-300 text-center"></td>
            </tr>
            </tfoot>
        </table>
    </div>
</x-dashboard>
