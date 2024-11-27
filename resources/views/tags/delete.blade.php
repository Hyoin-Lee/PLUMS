<x-dashboard>
    <div class="mx-auto bg-white rounded-lg">
        <h2 class="text-xl font-semibold text-gray-800">Delete Tag</h2>
        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <p class="text-lg text-gray-800">Are you sure you want to delete this tag? This action cannot be undone!</p>
            <p class="text-lg text-gray-800 mb-2">Please note you cannot delete a tag if one or more questions are assigned to it.</p>

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Certificate Name</label>
                <p id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $tag["name"] ?? "" }}
                </p>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Questions</label>
                <p id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ count($tag["questions"]) ?? "No questions." }}
                </p>
            </div>

            <div class="flex flex-row items-center justify-center gap-2">
                @if(count($tag["questions"]) === 0)
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Delete Tag</button>
                @endif
                <a href="{{ route('tags.index') }}" class="block bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
            </div>
        </form>
    </div>
</x-dashboard>
