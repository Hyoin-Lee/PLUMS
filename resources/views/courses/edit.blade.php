<x-dashboard>
    <h2 class="text-xl font-semibold mb-2">Edit Course</h2>
    <form action="{{ route('courses.update', $course->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input
                id="title"
                name="title"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                value="{{ $course["title"] ?? "" }}"
            >
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea
                id="description"
                name="description"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
            >{{ $course["description"] ?? "" }}</textarea>
        </div>

        <div class="flex flex-row items-center justify-center gap-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Update Course</button>
            <a href="{{ route('courses.index') }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
        </div>
    </form>
</x-dashboard>
