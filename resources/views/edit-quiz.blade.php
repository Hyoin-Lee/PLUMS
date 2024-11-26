<x-dashboard>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-3xl font-bold text-center text-purple-800 mb-6">Edit Quiz</h1>

                <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $quiz->title) }}" class="mt-1 block w-full">
                    </div>

                    <!-- Add more fields as needed -->

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Update Quiz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard>
