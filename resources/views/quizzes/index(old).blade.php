<x-dashboard>
    <div class="max-w-7xl w-full bg-gray-100 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-center text-purple-800 mb-6">Manage Quizzes</h1>

        <div class="grid grid-cols-1 gap-8">
            <!-- Add Question Form -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <form class="p-6" action="{{ route('quizzes.store') }}" method="POST">
                    @csrf
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Add Question</h2>
                    <div class="mb-4">
                        <label for="question" class="block text-sm font-medium text-gray-700">Question:</label>
                        <textarea id="question" name="question" rows="3" class="form-textarea mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="optionA" class="block text-sm font-medium text-gray-700">Option A:</label>
                        <input type="text" id="optionA" name="optionA" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="optionB" class="block text-sm font-medium text-gray-700">Option B:</label>
                        <input type="text" id="optionB" name="optionB" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="optionC" class="block text-sm font-medium text-gray-700">Option C:</label>
                        <input type="text" id="optionC" name="optionC" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="optionD" class="block text-sm font-medium text-gray-700">Option D:</label>
                        <input type="text" id="optionD" name="optionD" class="form-input mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                    </div>
                    <div class="mb-4">
                        <label for="correctAnswer" class="block text-sm font-medium text-gray-700">Correct Answer:</label>
                        <select id="correctAnswer" name="correctAnswer" class="form-select mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Add Question</button>
                    </div>
                </form>
            </div>

            <!-- Questions Table -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Questions Table</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Option A</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Option B</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Option C</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Option D</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correct</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Sample row, replace with dynamically generated rows -->
                            @foreach ($quizzes as $quiz)
                                @foreach ($quiz->questions as $question)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->parent->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $question->question_text }}</td>
                                        @foreach ($question->answers as $answer)
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $answer->answer_text }}</td>
                                        @endforeach
                                        <!-- Ensure is_correct is used as a boolean (1/0) in the database -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $question->answers->firstWhere('is_correct', true)->answer_text ?? '' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                            <!-- End of sample row -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quiz List Button -->
                <div class="p-6 text-right">
                    <a href="{{ route('quizzeslist') }}" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Quiz List</a>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
