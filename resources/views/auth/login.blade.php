<x-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="flex max-w-4xl w-full bg-white rounded-lg overflow-hidden shadow-lg">
            <div class="flex-1 flex justify-center items-center bg-gradient-to-r from-purple-300 to-purple-500">
                <div class="max-w-xs text-center text-white">
                    <h1 class="text-4xl font-bold mb-4">Welcome to PLUMS</h1>
                    <p class="text-lg mb-2">Manage your quizzes and courses efficiently with the PLUMS admin dashboard.</p>
                    <p class="text-lg">Please log in to continue.</p>
                </div>
            </div>
            <div class="flex-1 flex justify-center items-center p-8">
                <div class="w-full max-w-md bg-white rounded-lg p-6 shadow-md">
                    <h2 class="text-2xl font-bold text-purple-600 mb-6">Login</h2>

                    @if(session('error'))
                        <div class="text-red-500 mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf
                        <label for="email" class="block text-lg text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" required class="border border-gray-300 rounded-md p-2 w-full mb-4" />

                        @error('email')
                        <div class="text-red-500 mb-4">
                            {{ $message }}
                        </div>
                        @enderror

                        <label for="password" class="block text-lg text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" required class="border border-gray-300 rounded-md p-2 w-full mb-4" />

                        @error('password')
                        <div class="text-red-500 mb-4">
                            {{ $message }}
                        </div>
                        @enderror
                        
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 w-full">Login</button>
                        <p class="text-center text-gray-600 mt-4"><a href="#" class="text-indigo-600 hover:underline">Forgot password?</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
