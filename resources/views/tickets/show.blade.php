<x-app-layout>
    <x-slot name="header">
        {{ $ticket->title }}
    </x-slot>

    @hasanyrole('admin|agent')
        <div class="mb-4 flex justify-end">
            @if($ticket->isOpen())
                <form action="{{ route('tickets.close', $ticket) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PATCH')
                    <x-primary-button>
                        بسته
                    </x-primary-button>
                </form>
            @elseif(!$ticket->isArchived())
                <form action="{{ route('tickets.reopen', $ticket) }}" method="POST" class="mr-2" style="display: inline-block;">
                    @csrf
                    @method('PATCH')
                    <x-primary-button>
                        درانتظار پاسخ
                    </x-primary-button>
                </form>

                <form action="{{ route('tickets.archive', $ticket) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('PATCH')
                    <x-primary-button>
                        ارشیو شده
                    </x-primary-button>
                </form>
            @endif
        </div>
    @endhasanyrole

    <div class="space-y-4">
        <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs">
		    <div class="bg-white px-2 py-1 border-b">
                {{ $ticket->title }}
            </div>
            <p class="text-gray-600 px-2 py-3">
                {!! $ticket->message !!}
            </p>
        </div>
        @if($ticket->getMedia('tickets_attachments')->count())
            <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs">
                <h4 class="mb-4 font-semibold text-gray-600">
                    فایل های ضمیمه
                </h4>

                @foreach($ticket->getMedia('tickets_attachments') as $media)
                    <div>
                        <a href="{{ route('attachment-download', $media) }}" class="hover:underline">{{ $media->file_name }}</a>
                        
                        <span class="px-2 text-blue-500">
                            <span class="text-sm px-1">
                                تاریخ بارگذاری فایل:
                            </span>
                            {{ $media->created_at }}
                        </span>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs space-y-4">
            <h4 class="mb-4 font-semibold text-gray-600">
                پیام ها
            </h4>

            @if(!$ticket->isArchived())
                <form action="{{ route('message.store', $ticket) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <textarea id="message"
                                  name="message"
                                  class="ckeditor mt-1 block h-32 w-full rounded-md border-gray-300 shadow-sm focus-within:text-primary-600 focus:border-primary-300 focus:ring-primary-200 focus:ring focus:ring-opacity-50"
                                  >{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <input type="file" name="attachments[]" multiple>
                    </div>

                    <x-primary-button class="mt-4">
                        ذخیره تغییرات
                    </x-primary-button>
                </form>
            @endif

            @forelse($ticket->messages as $message)
                <div class="rounded-lg bg-white shadow-lg border border-gray-200 pt-3">
                    <div class="flex items-center border-b border-gray-200 p-3">
                        <div class="text-md font-bold">
                            {{ $message->user->name }}
                        </div>
                        <div class="px-2">
                             <span class="text-sm p-1">
                                تاریخ ایجاد تیکت:
                             </span>
                            {{ $message->created_at }}
                        </div>
                    </div>
                    <div class="p-5">
                        {!! $message->message !!}
                    </div>
                </div>
            @empty
                <p class="text-gray-600">
                    پیامی یافت نشد.
                </p>
            @endforelse
        </div>
    </div>
</x-app-layout>