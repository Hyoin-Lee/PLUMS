<x-dashboard>
{{--    <div class="container mx-auto p-6 bg-white">--}}
        <h1 class="text-xl font-semibold text-gray-800 mb-2">Edit Answer</h1>

        <form action="{{ route('answers.update', $answer) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="number" name="question_id" id="question_id" value="{{$answer->question_id}}" class="hidden">

            <div class="mb-2">
                <label for="answer" class="block text-sm font-medium text-gray-700">Answer</label>
                <input
                    type="text"
                    name="answer"
                    id="answer"
                    value="{{ old('answer', $answer->answer) }}"
                    placeholder="Enter Answer Text"
                    class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
                    required>
            </div>

            <div class="mb-4">
                <label for="correct" class="block w-full text-sm font-medium text-gray-700">Correct Answer</label>
                <select
                    id="correct"
                    name="correct"
                    class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50">
                    <option value="1" {{ $answer->correct == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $answer->correct == 0 ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="flex items-center justify-center gap-2">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Update Answer</button>
                <a href="{{ route('questions.edit', ['question' => $answer->question_id]) }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
            </div>
        </form>
{{--    </div>--}}
</x-dashboard>
