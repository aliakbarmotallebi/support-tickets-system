<!DOCTYPE html>
<html x-data="data" lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Scripts -->
        <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>
<body>

    <div class="flex items-center min-h-screen p-6 bg-[#2563EB]">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden rounded-lg p-4">
            <div class="ml-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" fill="none"
                    viewBox="0 0 32 32">
                    <g clip-path="url(#a)">
                        <path fill="#2563EB"
                            d="M21.867 31.98H.021V10.132C.02 4.548 4.549.018 10.135.018h11.732c5.586 0 10.115 4.529 10.115 10.114v11.733c-.002 5.588-4.529 10.115-10.114 10.115Z" />
                        <path fill="#fff"
                            d="m9.48 16.78-1.741-1.74a3.908 3.908 0 0 1-.01-5.514l2.97-2.99a1.418 1.418 0 0 1 2.011-.003l.026.026c.573.573.57 1.492 0 2.055-.901.889-2.176 2.161-2.967 2.952-.4.4-.4 1.045 0 1.444l.727.727c.56.56.56 1.47 0 2.03L9.48 16.781Zm11.947-1.53 1.741 1.74a3.89 3.89 0 0 1 0 5.505l-2.972 2.974a1.435 1.435 0 1 1-2.03-2.03l2.972-2.972c.4-.4.4-1.047 0-1.446l-.727-.727c-.56-.56-.56-1.47 0-2.03l1.016-1.014Zm-9.352 4.13-1.013-1.014 5.724-5.725c.56-.56 1.47-.56 2.03 0l1.014 1.014-5.724 5.724c-.561.56-1.47.56-2.03 0Z" />
                    </g>
                    <defs>
                        <clipPath id="a">
                            <path fill="#fff" d="M0 0h32v32H0z" />
                        </clipPath>
                    </defs>
                </svg>
            </div>
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
        </div>
    </div>

</body>
</html>