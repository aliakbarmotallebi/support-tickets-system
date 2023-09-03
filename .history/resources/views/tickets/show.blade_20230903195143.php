<x-app-layout>
    <x-slot name="header">
        {{ $ticket->title }}
    </x-slot>

    <div class="p-4">
      @if ($ticket->status == 'closed')
            <span class="bg-gray-100 text-gray-800 text-lg inline font-semibold mr-2 px-2.5 py-0.5 rounded  ">
            {{ $ticket->getStatusText() }}
            </span>
        @elseif ($ticket->status == 'open')
            <span class="bg-blue-100 text-blue-800 text-lg inline font-semibold mr-2 px-2.5 py-0.5 rounded  ">
            {{ $ticket->getStatusText() }}
            </span>
        @elseif ($ticket->status == 'solved')
            <span class="bg-green-100 text-green-800 text-lg inline font-semibold mr-2 px-2.5 py-0.5 rounded  ">
            {{ $ticket->getStatusText() }}
            </span>
        @elseif ($ticket->status == 'new')
            <span class="bg-yellow-100 text-yellow-800 text-lg inline font-semibold mr-2 px-2.5 py-0.5 rounded  ">
            {{ $ticket->getStatusText() }}
            </span>
        @endif
   </div>

    <div class="space-y-4">
        <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs">
		    <div class="bg-white border-b">
                <div class="px-4 py-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline ml-1" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M5.463 4.433A9.961 9.961 0 0 1 12 2c5.523 0 10 4.477 10 10 0 2.136-.67 4.116-1.81 5.74L17 12h3A8 8 0 0 0 6.46 6.228l-.997-1.795zm13.074 15.134A9.961 9.961 0 0 1 12 22C6.477 22 2 17.523 2 12c0-2.136.67-4.116 1.81-5.74L7 12H4a8 8 0 0 0 13.54 5.772l.997 1.795z"/></svg>

                    <span class="font-bold">
                        تاریخ بروزرسانی:
                    </span>    
                {{ verta($ticket->updated_at) }}
                </div>
                <div class="px-4 py-3 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="inline ml-1" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M17 3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4V1h2v2h6V1h2v2zm-2 2H9v2H7V5H4v4h16V5h-3v2h-2V5zm5 6H4v8h16v-8z"/></svg>
                                    <span class="font-bold">
                        تاریخ ایجاد تیکت:
                    </span> 
                {{ verta($ticket->created_at) }}
                </div>
            </div>
            <p class="text-gray-600 px-2 py-3">
                                                <span class="font-bold">
                       متن اصلی پیام: 
                    </span> 
                {!! $ticket->message !!}
            </p>
        </div>
        @if($ticket->getMedia('tickets_attachments')->count())
            <div class="min-w-0 rounded-lg bg-white p-4 shadow-xs">
                <h4 class="mb-4 font-semibold text-gray-600">
                    فایل های ضمیمه
                </h4>

                @foreach($ticket->getMedia('tickets_attachments') as $i => $media)
                    <div>
                        <a href="{{ route('attachment-download', $media) }}" class="hover:underline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline ml-1" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12.414 5H21a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h7.414l2 2zM13 13V9h-2v4H8l4 4 4-4h-3z"/></svg>
                            فایل شماره
                            #{{$i}}
                        </a>
                        
                        <span class="px-2 text-blue-500">
                            <span class="text-sm px-1">
                                تاریخ بارگذاری فایل:
                            </span>
                            {{ verta()->parse($media->created_at)->format('Y-n-j H:i') }}
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
                <div class="rounded-lg bg-white shadow-lg border border-gray-200 overflow-hidden">
                    <div class="flex justify-between items-center border-b border-gray-200 p-3 pt-3  {{ $message->user->hasRole('admin', 'web')? 'bg-gray-50 text-gray-500':''}}">
                        <div class="text-md font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline ml-1 fill-current" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"/></svg>
                            {{ $message->user->name }}
                        </div>
                        <div class="px-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="inline ml-1 fill-current" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M17 3h4a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h4V1h2v2h6V1h2v2zm-2 2H9v2H7V5H4v4h16V5h-3v2h-2V5zm5 6H4v8h16v-8z"/></svg>

                             <span class="text-sm p-1 font-bold">
                                تاریخ ایجاد تیکت:
                             </span>
                            {{ verta($message->created_at)->format('Y-n-j H:i') }}
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