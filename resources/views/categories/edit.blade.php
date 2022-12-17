<x-app-layout>
    <x-slot name="header">
        ویرایش دسته بندی
    </x-slot>

    <div class="rounded-lg bg-white p-4 shadow-md">

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" />
    نام
                </x-input-label>
                <x-text-input type="text"
                              id="name"
                              name="name"
                              class="block w-full"
                              value="{{ old('name', $category->name) }}"
                              required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <div class="mt-1 inline-flex space-x-1 space-x-reverse">
                    <input class="text-purple-600 form-checkbox focus:shadow-outline-purple focus:border-purple-400 focus:outline-none"
                           type="checkbox" name="is_visible" id="is_visible" value="1"
                            @checked(old('is_visible', $category->is_visible))>
                    <x-input-label for="is_visisble">
                        قابل رویت؟
                    </x-input-label>
                </div>
                <x-input-error :messages="$errors->get('is_visible')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-primary-button>
                    ذخیره تغییرات
                </x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>
