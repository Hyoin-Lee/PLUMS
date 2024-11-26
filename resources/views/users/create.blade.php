<x-dashboard>
    <h2 class="text-xl font-semibold text-gray-800 mb-2">Create User</h2>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-2">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input
                id="name"
                name="name"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
                placeholder="Enter user name"
                required
            >
        </div>

        <div class="mb-2">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                id="email"
                name="email"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
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
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
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
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
                placeholder="Confirm password"
                required
            >
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select
                id="role"
                name="role"
                class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-3 focus:border-orange-500 focus:ring focus:ring-orange-500 focus:ring-opacity-50"
                required
            >
                <option value="admin" selected>Admin</option>
                <option value="staff">Staff</option>
            </select>
        </div>

        <div class="flex flex-row items-center justify-center gap-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Create User</button>
            <a href="{{ route('users.index') }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
        </div>
    </form>
</x-dashboard>
