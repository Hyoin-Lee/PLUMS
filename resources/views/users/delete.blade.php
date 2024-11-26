<x-dashboard>
    <div class="container mx-auto p-6 bg-white">
        <h1 class="text-2xl font-bold mb-6">Delete User</h1>

        <p>Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>

        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex items-center justify-center gap-2">
                <button type="submit" class="bg-purple-600 text-white p-2 rounded">Delete User</button>
                <a href="{{ route('users.index') }}" class="bg-red-600 text-white p-2 rounded">Cancel</a>
            </div>
        </form>
    </div>
</x-dashboard>
