<x-dashboard>
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Create New Quiz</h2>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf

        <div class="mb-2">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                placeholder="Enter Title Text"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
                required>
        </div>

        <div class="mb-2">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <input
                type="text"
                name="description"
                id="description"
                placeholder="Enter Description Text"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
                required>
        </div>

        <div class="mb-2">
            <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
            <select
                name="course_id"
                id="course_id"
                class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
            >
                <option value="">None</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-row items-center justify-center gap-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Create Quiz</button>
            <a href="{{ route('quizzes.index') }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
        </div>
    </form>
</x-dashboard>
