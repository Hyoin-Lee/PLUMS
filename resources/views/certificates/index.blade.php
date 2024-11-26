<x-dashboard>
    <div class="container mx-auto p-6 bg-white">
        <h1 class="text-3xl font-bold text-center text-purple-800 mb-6">Certificates List</h1>
        <section class="flex justify-between items-center mb-4">
            <a href="{{ route('certificates.create') }}"
                class="bg-purple-500 text-white p-2 rounded hover:bg-purple-800
                    duration-300 ease-in-out transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('New Certificate') }}
            </a>
        </section>

        <section class="flex justify-between items-center mb-4">
            <form action="{{ route('certificates.index') }}" method="GET" class="w-full">
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by certificate name"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-purple-500 transition duration-200">
            </form>
        </section>

        <!-- Courses Table -->
        <table class="min-w-full bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-300">
            <thead class="bg-purple-500 text-white">
            <tr class="w-full">
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Cert Name</th>
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Threshold</th>
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Level</th>
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Actions</th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 text-center">
            @foreach($certificates as $certificate)
                <tr>
                    <td class="py-2 px-4 text-center border-b border-gray-200">{{ $certificate['cert_name'] }}</td>
                    <td class="py-2 px-4 text-center border-b border-gray-200">
                        {{ $certificate['threshold'] ?? 0 }}
                    </td>
                    <td class="py-2 px-4 text-center border-b border-gray-200">
                        {{ $certificate['level'] ?? "None" }}
                    </td>
                    <td class="py-2 px-4 text-center border-b border-gray-200">
                        <div class="flex justify-center space-x-2">
                            <form action="{{ route('certificates.edit', $certificate->id) }}" method="GET">
                                @csrf
                                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-1 px-3 rounded-md transition duration-200">Edit</button>
                            </form>
                            <form action="{{ route('certificates.delete', $certificate->id) }}" method="GET">
                                @csrf
                                <button class="w-full bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded-md transition duration-200">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr class="w-full">
                <td colspan="4" class="py-2 px-4 bg-gray-100 border-t border-gray-300 text-center">
                    @if($certificates->hasPages())
                        {{ $certificates->links() }}
                    @else
                        <small>No pages.</small>
                    @endif
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</x-dashboard>
