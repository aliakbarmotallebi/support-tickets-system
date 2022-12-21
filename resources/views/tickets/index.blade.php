<x-app-layout>
    <x-slot name="header">
        لیست تیکت ها
    </x-slot>

    <div class="mb-4 flex justify-between">
        <a class="rounded-lg border border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600" href="{{ route('tickets.create') }}">
            افزودن
        </a>
        <div class="flex space-x-2 space-x-reverse">
            <select class="block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50" name="status" id="status" onChange="window.location.href=this.value">
                <option value="{{ clearQueryString('status') }}">
                    انتخاب وضعیت
                </option>
                @foreach(\App\Enums\Status::cases() as $status)
                    <option value="{{ toggle('status', $status->value) }}" @selected($status->value == request('status'))>{{ $status->name }}</option>
                @endforeach
            </select>

            <select class="block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50" name="priority" id="priority" onchange="window.location.href=this.value">
                <option value="{{ clearQueryString('priority') }}">
                    انتخاب اولیت
                </option>
                @foreach(\Coderflex\LaravelTicket\Enums\Priority::cases() as $priority)
                    <option value="{{ toggle('priority', $priority->value) }}" @selected($priority->value == request('priority'))>{{ $priority->name }}</option>
                @endforeach
            </select>

            <select class="block w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50" name="category" id="category" onchange="window.location.href=this.value">
                <option value="{{ clearQueryString('category') }}">
                    انتخاب دسته بندی
                </option>
                    @foreach(\App\Models\Category::pluck('name', 'id') as $id => $name)
                        <option value="{{ toggle('category', (string) $id) }}" @selected($id == request('category'))>{{ $name }}</option>
                    @endforeach
            </select>
        </div>
    </div>

    <div class="rounded-lg bg-white p-4 shadow-xs">

        <div class="mb-8 w-full overflow-hidden rounded-lg border shadow-xs">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr class="border-b bg-gray-50 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="px-4 py-3">عنوان</th>
                            <th class="px-4 py-3">کاربر</th>
                            <th class="px-4 py-3">وضعیت</th>
                            <th class="px-4 py-3">اولیت</th>
                            <th class="px-4 py-3">دسته بندی</th>
                            <th class="px-4 py-3">برچسب ها</th>
                            @hasanyrole('admin|agent')
                                <th class="px-4 py-3">
                                اختصاص به
                                </th>
                            @endhasanyrole
                            <th class="px-4 py-3">تاریخ بروزرسانی</th>
                            <th class="px-4 py-3">تاریخ ایجاد</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @forelse($tickets as $ticket)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="hover:underline">{{ $ticket->title }}</a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $ticket->user->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($ticket->status == 'closed')
                                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                                        {{ $ticket->getStatusText() }}
                                        </span>
                                    @elseif ($ticket->status == 'open')
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                        {{ $ticket->getStatusText() }}
                                        </span>
                                    @elseif ($ticket->status == 'solved')
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">
                                        {{ $ticket->getStatusText() }}
                                        </span>
                                    @elseif ($ticket->status == 'new')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-900">
                                        {{ $ticket->getStatusText() }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($ticket->priority == 'low')
                                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                                        {{ $ticket->getPriorityText() }}
                                        </span>
                                    @elseif ($ticket->priority == 'high')
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                        {{ $ticket->getPriorityText() }}
                                        </span>
                                    @elseif ($ticket->priority == 'normal')
                                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">
                                        {{ $ticket->getPriorityText() }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @foreach($ticket->categories as $category)
                                        <span class="rounded-full bg-gray-50 px-2 py-2">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @foreach($ticket->labels as $label)
                                        <span class="rounded-full bg-gray-50 px-2 py-2">{{ $label->name }}</span>
                                    @endforeach
                                </td>
                                @hasanyrole('admin|agent')
                                    <td class="px-4 py-3 text-sm">
                                        {{ $ticket->assignedToUser->name ?? '' }}
                                    </td>
                                @endhasanyrole
                                                                <td class="px-4 py-3 text-sm">
                                    {{ verta($ticket->updated_at) }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ verta($ticket->created_at) }}
                                </td>
                                <td class="px-4 py-3 space-x-2 space-x-reverse">
                                    @hasanyrole('admin|agent')
                                        <a class="rounded-lg border-2 border-transparent bg-purple-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-purple-700 focus:outline-none focus:ring active:bg-purple-600" href="{{ route('tickets.edit', $ticket) }}">
                                           ویرایش
                                        </a>
                                    @endhasanyrole

                                    @role('admin')
                                        <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button>
                                                حذف
                                            </x-primary-button>
                                        </form>
                                    @endrole
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-3" colspan="4">
                                    تیکتی یافت نشد.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($tickets->hasPages())
                <div class="border-t bg-gray-50 px-4 py-3 text-xs font-semibold uppercase tracking-wide text-gray-500 sm:grid-cols-9">
                    {{ $tickets->withQueryString()->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
