<x-dashboard>
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Update Certificate</h2>
    <form action="{{ route('certificates.update', $certificate->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="cert_name" class="block text-sm font-medium text-gray-700">Certificate Name</label>
            <input
                type="text"
                id="cert_name"
                name="cert_name"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                placeholder="Enter certificate name title"
                value="{{ old('cert_name', $certificate->cert_name) }}"
                required
            >
        </div>

        <div class="mb-4">
            <label for="threshold" class="block text-sm font-medium text-gray-700">Threshold</label>
            <input
                type="number"
                id="threshold"
                name="threshold"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                placeholder="Enter certificate threshold"
                value="{{ old('threshold', $certificate->threshold) }}"
                required
            >
        </div>

        <div class="mb-4">
            <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
            <input
                type="number"
                id="level"
                name="level"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                placeholder="Enter certificate level"
                value="{{ old('level', $certificate->level) }}"
                required
            >
        </div>

        <div class="flex flex-row items-center justify-center gap-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Update Certificate</button>
            <a href="{{ route('certificates.index') }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
        </div>
    </form>
</x-dashboard>
