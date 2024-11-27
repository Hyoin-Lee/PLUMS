<x-dashboard>
    <!-- Content area -->
    <main class="flex-1 p-4 overflow-y-auto">
        <!-- Dashboard sections -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Users Card -->
            <div class="bg-white rounded-lg p-4 border">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('users.index') }}" class="text-lg font-bold text-gray-800">Users</a>
                        <p class="text-gray-600">{{$userCount}}</p>
                    </div>
                    <svg class="w-8 h-8 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>

            <!-- Quizzes Card -->
            <div class="bg-white rounded-lg p-4 border">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('quizzes.index') }}" class="text-lg font-bold text-gray-800">Quizzes</a>
                        <p class="text-gray-600">{{$quizCount}}</p>
                    </div>
                    <svg class="w-8 h-8 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                    </svg>

                </div>
            </div>

            <!-- Courses Card -->
            <div class="bg-white rounded-lg p-4 border">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('courses.index') }}" class="text-lg font-bold text-gray-800">Courses</a>
                        <p class="text-gray-600">{{$courseCount}}</p>
                    </div>
                    <svg class="w-8 h-8 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M3 7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7ZM5 7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2H5V7Zm0 4v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6H5ZM11 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm2 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm-1 3.5a1.5 1.5 0 0 0-1.5 1.5v1h3v-1a1.5 1.5 0 0 0-1.5-1.5Z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>

            <!-- Questions Card -->
            <div class="bg-white rounded-lg p-4 border">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('courses.index') }}" class="text-lg font-bold text-gray-800">Questions</a>
                        <p class="text-gray-600">{{$questionCount}}</p>
                    </div>
                    <svg class="w-8 h-8 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M3 7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7ZM5 7a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v2H5V7Zm0 4v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6H5ZM11 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm2 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm-1 3.5a1.5 1.5 0 0 0-1.5 1.5v1h3v-1a1.5 1.5 0 0 0-1.5-1.5Z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>

            <!-- Answers Card -->
            <div class="bg-white rounded-lg p-4 border">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('courses.index') }}" class="text-lg font-bold text-gray-800">Answers</a>
                        <p class="text-gray-600">{{$answerCount}}</p>
                    </div>
                    <svg class="w-8 h-8 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11 9a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"/>
                        <path fill-rule="evenodd" d="M9.896 3.051a2.681 2.681 0 0 1 4.208 0c.147.186.38.282.615.255a2.681 2.681 0 0 1 2.976 2.975.681.681 0 0 0 .254.615 2.681 2.681 0 0 1 0 4.208.682.682 0 0 0-.254.615 2.681 2.681 0 0 1-2.976 2.976.681.681 0 0 0-.615.254 2.682 2.682 0 0 1-4.208 0 .681.681 0 0 0-.614-.255 2.681 2.681 0 0 1-2.976-2.975.681.681 0 0 0-.255-.615 2.681 2.681 0 0 1 0-4.208.681.681 0 0 0 .255-.615 2.681 2.681 0 0 1 2.976-2.975.681.681 0 0 0 .614-.255ZM12 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" clip-rule="evenodd"/>
                        <path d="M5.395 15.055 4.07 19a1 1 0 0 0 1.264 1.267l1.95-.65 1.144 1.707A1 1 0 0 0 10.2 21.1l1.12-3.18a4.641 4.641 0 0 1-2.515-1.208 4.667 4.667 0 0 1-3.411-1.656Zm7.269 2.867 1.12 3.177a1 1 0 0 0 1.773.224l1.144-1.707 1.95.65A1 1 0 0 0 19.915 19l-1.32-3.93a4.667 4.667 0 0 1-3.4 1.642 4.643 4.643 0 0 1-2.53 1.21Z"/>
                    </svg>
                </div>
            </div>

            <!-- Results Card -->
            <div class="bg-white rounded-lg p-4 border">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('results.index') }}" class="text-lg font-bold text-gray-800">Results</a>
                        <p class="text-gray-600">{{$resultCount}}</p>
                    </div>
                    <svg class="w-8 h-8 text-purple-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M11 9a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"/>
                        <path fill-rule="evenodd" d="M9.896 3.051a2.681 2.681 0 0 1 4.208 0c.147.186.38.282.615.255a2.681 2.681 0 0 1 2.976 2.975.681.681 0 0 0 .254.615 2.681 2.681 0 0 1 0 4.208.682.682 0 0 0-.254.615 2.681 2.681 0 0 1-2.976 2.976.681.681 0 0 0-.615.254 2.682 2.682 0 0 1-4.208 0 .681.681 0 0 0-.614-.255 2.681 2.681 0 0 1-2.976-2.975.681.681 0 0 0-.255-.615 2.681 2.681 0 0 1 0-4.208.681.681 0 0 0 .255-.615 2.681 2.681 0 0 1 2.976-2.975.681.681 0 0 0 .614-.255ZM12 6a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" clip-rule="evenodd"/>
                        <path d="M5.395 15.055 4.07 19a1 1 0 0 0 1.264 1.267l1.95-.65 1.144 1.707A1 1 0 0 0 10.2 21.1l1.12-3.18a4.641 4.641 0 0 1-2.515-1.208 4.667 4.667 0 0 1-3.411-1.656Zm7.269 2.867 1.12 3.177a1 1 0 0 0 1.773.224l1.144-1.707 1.95.65A1 1 0 0 0 19.915 19l-1.32-3.93a4.667 4.667 0 0 1-3.4 1.642 4.643 4.643 0 0 1-2.53 1.21Z"/>
                    </svg>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white rounded-lg p-4 col-span-1 md:col-span-2 lg:col-span-3 mt-4 border">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Recent Activities</h2>
                <ul>
                    @foreach($recentResults as $result)
                        <li class="flex items-center justify-between py-2 border-b border-gray-200">
                            <span>{{ ($result->user->first_name ?? 'Unknown') . ' ' . ($result->user->last_name ?? 'Unknown') }} completed a quiz</span>
                            <span class="text-gray-600 text-sm">{{ $result->created_at->diffForHumans() }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Courses Highlights -->
{{--        <div class="grid grid-cols-2 gap-6 md:grid-cols-2 md:gap-6 lg:grid-cols-2 lg:gap-6 xl:grid-cols-2 xl:gap-6 mt-8">--}}
{{--            <!-- Course Card - Web Development -->--}}
{{--            <div class="bg-white rounded-lg p-6 flex flex-col justify-between">--}}
{{--                <div>--}}
{{--                    <h2 class="text-xl font-bold text-gray-800">Certificate III in IT (Web Development)</h2>--}}
{{--                    <p class="text-gray-600 mt-2">Quizzes Taken: 60</p>--}}
{{--                </div>--}}
{{--                <svg class="w-10 h-10 text-purple-600 mt-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                    <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd"/>--}}
{{--                </svg>--}}
{{--            </div>--}}

{{--            <!-- Course Card - Programming -->--}}
{{--            <div class="bg-white rounded-lg p-6 flex flex-col justify-between">--}}
{{--                <div>--}}
{{--                    <h2 class="text-xl font-bold text-gray-800">Certificate IV in IT (Programming)</h2>--}}
{{--                    <p class="text-gray-600 mt-2">Quizzes Taken: 40</p>--}}
{{--                </div>--}}
{{--                <svg class="w-10 h-10 text-purple-600 mt-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                    <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd"/>--}}
{{--                </svg>--}}
{{--            </div>--}}

{{--            <!-- Course Card - Advanced Programming -->--}}
{{--            <div class="bg-white rounded-lg p-6 flex flex-col justify-between">--}}
{{--                <div>--}}
{{--                    <h2 class="text-xl font-bold text-gray-800">Diploma of IT (Advanced Programming)</h2>--}}
{{--                    <p class="text-gray-600 mt-2">Quizzes Taken: 30</p>--}}
{{--                </div>--}}
{{--                <svg class="w-10 h-10 text-purple-600 mt-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                    <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd"/>--}}
{{--                </svg>--}}
{{--            </div>--}}

{{--            <!-- Course Card - Backend Web Development -->--}}
{{--            <div class="bg-white rounded-lg p-6 flex flex-col justify-between">--}}
{{--                <div>--}}
{{--                    <h2 class="text-xl font-bold text-gray-800">Diploma of IT (Back End Web Development)</h2>--}}
{{--                    <p class="text-gray-600 mt-2">Quizzes Taken: 25</p>--}}
{{--                </div>--}}
{{--                <svg class="w-10 h-10 text-purple-600 mt-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">--}}
{{--                    <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd"/>--}}
{{--                </svg>--}}
{{--            </div>--}}
{{--        </div>--}}
    </main>

</x-layout>
