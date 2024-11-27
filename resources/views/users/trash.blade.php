<x-dashboard>
    <div class="container mx-auto p-6 bg-white">
        <h1 class="text-2xl font-bold mb-6">Users</h1>

        @if(Session::has('success'))
            <section id="Messages" class="my-4 px-4">
                <div class="p-4 border-purple-500 bg-purple-100 text-purple-700 rounded-lg">
                    {{Session::get('success')}}
                </div>
            </section>
        @endif

        <section>
            <header class="flex flex-row justify-between items-center gap-2">
                <p class="font-semibold text-lg text-gray-800 leading-tight">
                    {{ __('Deleted users') }}
                </p>
                <section class="flex flex-row gap-2 items-center justify-end">
                    <a href="{{ route('users.index') }}"
                       class="p-2 px-4 text-center rounded-md
                              text-white hover:text-purple-200
                              bg-purple-600 hover:bg-purple-500
                              duration-200 ease-in-out transition-all">
                        <i class="fa fa-user text-lg"></i>
                        {{ __('Back to Users') }}
                    </a>

                    <form class="flex flex-row gap-2 items-center justify-end"
                          action="{{ route('users.trash-restore-all') }}"
                          method="POST">
                        @CSRF
                        <button type="submit"
                                class="p-2 px-4 text-center rounded-md text-white
                                       bg-purple-500 hover:bg-purple-600
                                       duration-200 ease-in-out transition-all">
                            <i class="fa fa-trash-arrow-up text-lg"></i>
                            {{ __('Recover All') }}
                        </button>
                    </form>

                    <form class="flex flex-row gap-2 items-center justify-end"
                          action="{{ route('users.trash-empty') }}"
                          method="post">
                        @CSRF
                        @method('delete')
                        <button type="submit"
                                class="p-2 px-4 text-center rounded-md text-white
                                       bg-red-500 hover:bg-red-600
                                       duration-200 ease-in-out transition-all">
                            <i class="fa fa-trash text-lg"></i>
                            {{ __('Empty All') }}
                        </button>
                    </form>
                </section>
            </header>
            <table class="min-w-full bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-300 mt-4">
                <thead class="py-1 px-2 bg-purple-700 text-white">
                <tr class="bg-purple-500 text-white">
                    <th class="py-2 px-4 text-left border-b border-gray-300 flex-1">Name</th>
                    <th class="py-2 px-4 text-left border-b border-gray-300 flex-1">Email</th>
                    <th class="py-2 px-4 text-left border-b border-gray-300 flex-1">Deleted At</th>
                    <th class="py-2 px-4 text-right border-b border-gray-300 flex-1">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="group border-t border-purple-200 text-gray-800">
                        <td class="py-2 pl-2 flex-0 text-left">{{ $user->name }}</td>
                        <td class="py-2 text-left">{{ $user->email }}</td>
                        <td class="py-2 text-left">{{ $user->updated_at }}</td>
                        <td class="py-2 pr-2 text-right">
                            <div class="flex flex-row gap-2 items-center justify-end">
                                <form action="{{ route('users.trash-restore', $user) }}"
                                      method="POST"
                                      style="display: inline-block;">

                                    @csrf
                                    <button type="submit"
                                            class="bg-purple-500 text-white p-2 rounded hover:bg-purple-600
                                                   duration-200 ease-in-out transition-all">
                                        Restore
                                        <span class="sr-only hidden">
                                            Restore user
                                        </span>
                                    </button>
                                </form>

                                <form class="flex flex-row gap-2 items-center justify-end"
                                      action="{{ route('users.trash-remove', $user) }}"
                                      method="post">
                                    @CSRF
                                    @method('delete')
                                    <button type="submit"
                                            class="bg-red-500 text-white p-2 rounded hover:bg-red-600
                                                   duration-200 ease-in-out transition-all">
                                        Delete
                                        <span class="sr-only hidden">
                                            Delete user
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4" class="py-2 px-4 bg-gray-100 border-t border-gray-300 text-center">
                        @if($users->hasPages())
                            {{ $users->links() }}
                        @else
                            <small>No pages</small>
                        @endif
                    </td>
                </tr>
                </tfoot>
            </table>

        </section>
    </div>
</x-dashboard>
