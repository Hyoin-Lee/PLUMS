<x-dashboard>
    <div class="container mx-auto p-6 bg-white">
        <h1 class="text-3xl font-bold text-center text-purple-800 mb-6">Manage Quizzes</h1>
        <section class="flex justify-between items-center mb-4">
            <!-- Add Quiz Button -->
            <a href="{{ route('quizzes.create') }}"
                class="bg-purple-500 text-white p-2 rounded hover:bg-purple-800 duration-300 ease-in-out transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('New Quiz') }}
            </a>

            <!-- Trash Button with Count
            <a href="{{ route('quizzes.trash') }}"
                class="text-slate-600 hover:text-slate-200 bg-slate-200 hover:bg-slate-500 py-2 px-4 rounded-md transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 6h14M3 9v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9m-9-4V2m4 0v3m-8 0v3m4 0v3m4 0v3" />
                </svg>
                Quizzes Deleted: <span class="font-bold">{{ $trashedCount }}</span>
            </a> -->
        </section>

        <!-- Quizzes table -->
        <table class="min-w-full bg-white overflow-hidden table-auto shadow-sm sm:rounded-lg border border-gray-300">
            <thead class="bg-purple-500 text-white">
            <tr class="w-full">
                <!-- <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">ID</th> -->
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Title</th>
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Course</th>
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Questions</th>
                <th class="py-2 px-4 text-center border-b border-gray-300 flex-1">Actions</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-center">
            @foreach($quizzes as $quiz)
                <tr class="w-full">
                    <!-- <td class="py-2 px-4 text-center border-b border-gray-200">{{ $quiz->id }}</td> -->
                    <td class="py-2 px-4 text-center border-b border-gray-200">{{ $quiz->title }}</td>
                    <td class="py-2 px-4 text-center border-b border-gray-200">{{ $quiz->course->title ?? 'N/A' }}</td>
                    <td class="py-2 px-4 text-center border-b border-gray-200">{{ count($quiz->questions) ?? '0' }}</td>
                    <td class="py-2 px-4 text-center border-b border-gray-200">
                        <div class="flex justify-center space-x-2">
                            <form action="{{ route('quizzes.edit', $quiz->id) }}" method="GET">
                                @csrf
                                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-1 px-3 rounded-md transition duration-200">Edit</button>
                            </form>
                            <form action="{{ route('quizzes.delete', $quiz->id) }}" method="GET">
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
                <td colspan="5" class="py-2 px-4 bg-gray-100 border-t border-gray-300 text-center">
                    @if($quizzes->hasPages())
                        {{ $quizzes->links() }}
                    @else
                        <small>No pages.</small>
                    @endif
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</x-dashboard>
