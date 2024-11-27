<x-dashboard>
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Create User</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-2">
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input
                id="first_name"
                name="first_name"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                placeholder="Enter user name"
                required
            >
        </div>

        <div class="mb-2">
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input
                id="last_name"
                name="last_name"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                placeholder="Enter user name"
                required
            >
        </div>

        <div class="mb-2">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                id="email"
                name="email"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                placeholder="Enter user email"
                required
            >
        </div>

        <div class="mb-2">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                placeholder="Enter password"
                required
            >
        </div>

        <div class="mb-2">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3"
                placeholder="Confirm password"
                required
            >
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select id="role" name="role" class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ $role->name == "student" ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-row items-center justify-center gap-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Create User</button>
            <a href="{{ route('users.index') }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
        </div>
    </form>
</x-dashboard>
