<x-dashboard>
    <div class="container mx-auto p-6 bg-white">
        <h1 class="text-3xl font-bold text-center text-purple-800 mb-6">Results</h1>

        <section class="flex justify-between items-center mb-4">
            <form action="{{ route('results.index') }}" method="GET" class="w-full">
                <input type="text" name="query" value="{{ request('query') }}" placeholder="Search by course / student"
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:border-purple-500 transition duration-200">
            </form>
        </section>

        <table class="min-w-full bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-300">
            <thead class="bg-purple-500 text-white">
            <tr>
                <th class="py-2 px-4 text-center border-b border-gray-300">Student</th>
                <th class="py-2 px-4 text-center border-b border-gray-300">Quiz</th>
                <th class="py-2 px-4 text-center border-b border-gray-300">Course</th>
                <th class="py-2 px-4 text-center border-b border-gray-300">Score</th>
                <th class="py-2 px-4 text-center border-b border-gray-300">Recommendation</th>
                <th class="py-2 px-4 text-center border-b border-gray-300">Actions</th>
            </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 text-center">
            @foreach($results as $quizResult)
                <tr>
                    <td class="py-2 px-4 border-b border-gray-200">{{ ($quizResult->user->first_name ?? 'Unknown') . ' ' . ($quizResult->user->last_name ?? 'Unknown') }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $quizResult->quiz->title ?? 'Dynamic' }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $quizResult->quiz ? $quizResult->quiz->course->title: $quizResult->course->title ?? 'Static' }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ round(($quizResult->score / $quizResult->total_score) * 100, 2) }}%</td>
                    <td class="py-2 px-4 border-b border-gray-200">{{ $quizResult->recommended_cert->cert_name ?? "None" }}</td>
                    <td class="py-2 px-4 border-b border-gray-200">
                        <form action="{{ route('results.show', $quizResult->id) }}" method="GET">
                            @csrf
                            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-1 px-3 rounded-md transition duration-200">Details</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>

            <tfoot>
            <tr>
                <td colspan="6" class="py-2 px-4 bg-gray-100 border-t border-gray-300 text-center">
                    @if($results->hasPages())
                        {{ $results->links() }}
                    @else
                        <small>No pages.</small>
                    @endif
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</x-dashboard>
