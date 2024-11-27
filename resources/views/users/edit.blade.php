<x-dashboard>
    <h2 class="text-xl font-semibold text-gray-800">Edit User</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input
                id="first_name"
                name="first_name"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2"
                value="{{ old('first_name', $user->first_name) }}"
                placeholder="Enter first name"
                required
            >
        </div>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input
                id="last_name"
                name="last_name"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2"
                value="{{ old('last_name', $user->last_name) }}"
                placeholder="Enter last name"
                required
            >
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2"
                placeholder="Enter new password"
            >
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2"
                value="{{ old('email', $user->email) }}"
                placeholder="Enter email address"
                required
            >
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input
                id="phone_number"
                name="phone_number"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2"
                value="{{ old('phone_number', $user->phone_number) }}"
                placeholder="Enter phone number"
            >
        </div>

        <div class="mb-4">
            <label for="birth_date" class="block text-sm font-medium text-gray-700">Birth Date</label>
            <input
                id="birth_date"
                name="birth_date"
                type="date"
                class="form-input mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2"
                value="{{ old('birth_date', $user->birth_date) }}"
            >
        </div>

        <div class="mb-4">
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select id="gender" name="gender" class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                <option value="male" {{ (old('gender', $user->gender) == 'male') ? 'selected' : '' }}>Male</option>
                <option value="female" {{ (old('gender', $user->gender) == 'female') ? 'selected' : '' }}>Female</option>
                <option value="undisclosed" {{ (old('gender', $user->gender) == 'undisclosed') ? 'selected' : '' }}>Undisclosed</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select id="role" name="role" class="form-select mt-1 block w-full border border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->getRoleId() == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-row items-center justify-center gap-2">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-md transition duration-300">Update User</button>
            <a href="{{ route('users.index') }}" class="block bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md transition duration-300">Cancel</a>
        </div>
    </form>
</x-dashboard>
