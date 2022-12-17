<x-app-layout>
    <x-slot name="header">
        ویرایش کاربر
    </x-slot>

    <div class="rounded-lg bg-white p-4 shadow-md">

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" >
نام
                     </x-input-label>
                <x-text-input type="text"
                              id="name"
                              name="name"
                              class="block w-full"
                              value="{{ old('name', $user->name) }}"
                              required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="mobile">
شماره همراه
                     </x-input-label>
                <x-text-input type="text"
                              id="mobile"
                              name="mobile"
                              class="block w-full"
                              value="{{ old('mobile', $user->mobile) }}"
                              required />
                <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password">
گذرواژه
                     </x-input-label>
                <x-text-input type="password"
                              id="password"
                              name="password"
                              class="block w-full"
                              value="{{ old('password') }}" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <div class="space-y-2">
                    <x-input-label for="role">
                    نقش
                         </x-input-label>
                    <div class="space-x-2">
                        @foreach($roles as $id => $name)
                            <div class="inline-flex space-x-1 space-x-reverse">
                                <input class="text-purple-600 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple" type="radio" name="role" id="role-{{ $id }}" value="{{ $id }}" @checked($id == old('role', $user->roles->contains($id)))>
                                <label class="text-sm text-gray-700" for="role-{{ $id }}">{{ $name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('role')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <x-primary-button>
                    ذخیره تغییرات
                </x-primary-button>
            </div>
        </form>

    </div>
</x-app-layout>
