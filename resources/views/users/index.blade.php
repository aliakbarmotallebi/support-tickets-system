<x-app-layout>
    <x-slot name="header">
       لیست کاربران
    </x-slot>

    <div class="mb-4 flex justify-between">
        <a class="rounded-lg border border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600" href="{{ route('users.create') }}">
            افزدون
        </a>
    </div>

    <div class="rounded-lg bg-white p-4 shadow-xs">

        <div class="mb-8 w-full overflow-hidden rounded-lg border shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="border-b bg-gray-50 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="px-4 py-3">نام کاربر</th>
                            <th class="px-4 py-3">شماره همراه</th>
                            <th class="px-4 py-3">نقش</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach($users as $user)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->mobile }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="rounded-full bg-gray-50 px-2 py-2">{{ $user->roles()->first()->name }}</span>
                                </td>
                                <td class="px-4 py-3 space-x-2 space-x-reverse">
                                    <a class="rounded-lg border-2 border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600" href="{{ route('users.edit', $user) }}">
                                        ویرایش
                                    </a>

                                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button>
                                            حذف
                                        </x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
