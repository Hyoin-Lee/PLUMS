<x-dashboard>
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Create New Certificate</h2>
    <form action="{{ route('certificates.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="cert_name" class="block text-sm font-medium text-gray-700">Certificate Name</label>
            <input
                type="text"
                id="cert_name"
                name="cert_name"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
                placeholder="Enter certificate name title"
                value="{{ old($certificate->cert_name) }}"
                required
            >
        </div>

        <div class="mb-4">
            <label for="threshold" class="block text-sm font-medium text-gray-700">Threshold</label>
            <input
                type="number"
                id="threshold"
                name="threshold"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
                placeholder="Enter certificate threshold"
                value="{{ old($certificate->threshold) }}"
                required
            >
        </div>

        <div class="mb-4">
            <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
            <input
                type="number"
                id="level"
                name="level"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
                placeholder="Enter certificate level"
                value="{{ old($certificate->level) }}"
                required
            >
        </div>

        <div class="flex flex-row items-center justify-center gap-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Create Certificate</button>
            <a href="{{ route('certificates.index') }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
        </div>
    </form>
</x-dashboard>
