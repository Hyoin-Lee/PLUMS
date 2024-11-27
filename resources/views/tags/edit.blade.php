<x-dashboard>
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Update Tag</h2>
    <form action="{{ route('tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Tag Name</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                placeholder="Enter tag name"
                value="{{ old('name', $tag->name) }}"
                required
            >
        </div>

        <div class="flex flex-row items-center justify-center gap-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Update Tag</button>
            <a href="{{ route('tags.index') }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
        </div>
    </form>
</x-dashboard>
