<x-dashboard>
    <div class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-red-600 mb-6 text-center">Delete Course</h2>
        <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <p class="text-lg text-gray-800 mb-4 text-center">Are you sure you want to delete this course? This action cannot be undone.</p>

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <p id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $course["title"] ?? "" }}
                </p>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <p id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $course["description"] ?? "" }}
                </p>
            </div>

            <div class="flex flex-col items-center gap-4">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9L12 15L18 9M6 15L12 9L18 15" />
                    </svg>
                    Delete Course
                </button>
                <a href="{{ route('courses.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md transition duration-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-dashboard>
