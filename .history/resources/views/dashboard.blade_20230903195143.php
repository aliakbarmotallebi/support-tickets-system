<x-app-layout>
    <x-slot name="header">
         سامانه تیکت کاربران 
    </x-slot>

    <div class="mb-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <!-- Total Tickets Card -->
        <div class="flex items-center rounded-lg bg-white shadow-xs">
            <a href="{{ route('tickets.index') }}" class="block flex w-full p-4">
                <div class="ml-4 h-full rounded-full bg-orange-100 p-3 text-orange-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">
                        تعداد تیکت ها
                    </p>
                    <p class="text-lg font-semibold text-gray-700">
                        {{ $totalTickets }}
                    </p>
                </div>
            </a>
        </div>

        <!-- Opened Tickets Card -->
        <div class="flex items-center rounded-lg bg-white shadow-xs">
            <a href="{{ route('tickets.index', ['status' => 'open']) }}" class="block flex w-full p-4">
                <div class="ml-4 h-full rounded-full bg-green-100 p-3 text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">
                       تیکت های ارسالی
                    </p>
                    <p class="text-lg font-semibold text-gray-700">
                        {{ $openTickets }}
                    </p>
                </div>
            </a>
        </div>

        <!-- Closed Tickets Card -->
        <div class="flex items-center rounded-lg bg-white shadow-xs">
            <a href="{{ route('tickets.index', ['status' => 'closed']) }}" class="block flex w-full p-4">
                <div class="ml-4 h-full rounded-full bg-blue-100 p-3 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                </div>
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">
                        تیکت های بسته شده
                    </p>
                    <p class="text-lg font-semibold text-gray-700">
                        {{ $closedTickets }}
                    </p>
                </div>
            </a>
        </div>
    </div>

<div class='flex flex-col bg-white border-t rounded-lg border border-gray-200' >
    <div class="flex items-center justify-between px-6 -mb-px border-b border-gray-200">
        <h3 class="text-blue-dark py-4 font-normal text-lg">
             آخرین تیکت های ارسالی
        </h3>
    </div>
    <div class="w-full {% block class_content %}{% endblock %}">
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
                    <th class="px-4 py-3">تاریخ بروزرسانی</th>
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
                                <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded  ">
                                {{ $ticket->getStatusText() }}
                                </span>
                            @elseif ($ticket->status == 'open')
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded  ">
                                {{ $ticket->getStatusText() }}
                                </span>
                            @elseif ($ticket->status == 'solved')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded  ">
                                {{ $ticket->getStatusText() }}
                                </span>
                            @elseif ($ticket->status == 'new')
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded  ">
                                {{ $ticket->getStatusText() }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if ($ticket->priority == 'low')
                                <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded  ">
                                {{ $ticket->getPriorityText() }}
                                </span>
                            @elseif ($ticket->priority == 'high')
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded  ">
                                {{ $ticket->getPriorityText() }}
                                </span>
                            @elseif ($ticket->priority == 'normal')
                                <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded  ">
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

                                                        <td class="px-4 py-3 text-sm">
                            {{ verta($ticket->updated_at) }}
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
    </div>
</div>



</x-app-layout>
