<x-dashboard>
    <div class="mx-auto bg-white rounded-lg">
        <h2 class="text-xl font-semibold text-gray-800">Delete Certificate</h2>
        <form action="{{ route('certificates.destroy', $certificate->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <p class="text-lg text-gray-800 mb-2">Are you sure you want to delete this certificate? This action cannot be undone!</p>

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Certificate Name</label>
                <p id="title" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $certificate["cert_name"] ?? "" }}
                </p>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Threshold</label>
                <p id="description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                    {{ $certificate["threshold"] ?? "" }}
                </p>
            </div>

            <div class="flex flex-row items-center justify-center gap-2">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Delete Certificate</button>
                <a href="{{ route('certificates.index') }}" class="block bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
            </div>
        </form>
    </div>
</x-dashboard>
