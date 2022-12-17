<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
                    @csrf
        <div class="w-full flex flex-col items-center p-10" >
            <!-- text login -->
            <h1 class="text-center text-2xl font-bold text-gray-600 mb-6">
                ورود به حساب کاربری
            </h1>
            <!-- email input -->
            <div class="w-3/4 mb-6">
                <input type="text" name="mobile" id="mobile" class="w-full text-right py-4 px-8 bg-slate-200 placeholder:font-semibold rounded hover:ring-1 outline-blue-500" placeholder="شماره همراه">
                <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
            </div>
            <!-- password input -->
            <div class="w-3/4 mb-6">
                <input type="password" name="password" id="password" class="w-full text-right py-4 px-8 bg-slate-200 placeholder:font-semibold rounded hover:ring-1 outline-blue-500 " placeholder="گذرواژه">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- remember input -->
            <div class="w-3/4 flex flex-row justify-between  text-right">
                <div class=" flex items-center gap-x-1 text-right">
                    <label for="" class="text-sm text-slate-400">
                        مرا بخاطر بسپار؟
                    </label>
                    <input type="checkbox" name="remember" id="" class=" w-4 h-4  ">
                </div>
            </div>
            <!-- button -->
            <div class="w-3/4 mt-4">
                <button type="submit" class="py-4 bg-blue-400 w-full rounded text-blue-50 font-bold hover:bg-blue-700"> 
                    ورود به حساب
                </button>
            </div>
        </div>
    </form>   

</x-guest-layout>
