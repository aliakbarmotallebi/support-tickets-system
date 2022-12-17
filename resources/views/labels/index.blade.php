<x-app-layout>
    <x-slot name="header">
        لیست برچسب ها
    </x-slot>

    <div class="flex mb-4">
        <a class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600" href="{{ route('labels.create') }}">
            افزدون
        </a>
    </div>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <div class="w-full mb-8 overflow-hidden border rounded-lg shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-right text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">نام</th>
                            <th class="px-4 py-3">اسلاگ</th>
                            <th class="px-4 py-3">رویت</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($labels as $label)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $label->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $label->slug }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $label->is_visible ? 'بله' : 'خیر' }}
                                </td>
                                <td class="px-4 py-3 space-x-2 space-x-reverse">
                                    <a class="px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border-2 border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600" href="{{ route('labels.edit', $label) }}">
                                        ویرایش
                                    </a>

                                    <form action="{{ route('labels.destroy', $label) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button>
                                            حذف
                                        </x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-3" colspan="4">
                                    برچسبی یافت نشد.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($labels->hasPages())
                <div class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t bg-gray-50 sm:grid-cols-9">
                    {{ $labels->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
