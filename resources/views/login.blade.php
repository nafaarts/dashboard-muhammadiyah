<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    {{-- <meta name="description" content="{{ $page->description }}"> --}}
    <title>Login - Muhammadiyah Banda Aceh</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="flex justify-center items-center h-screen bg-gray-200 px-6">
        <div class="p-6 max-w-sm w-full bg-white shadow-md rounded-md">
            <div class="flex justify-center items-center">
                <img src="{{ asset('logo.png') }}" alt="Logo Muhammadiyah">
            </div>
            <form class="mt-4" action="{{ route('login') }}" method="POST">
                @if (session('status'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg my-2" role="alert">
                        <p class="font-bold">Opps</p>
                        <small class="text-sm">{{ session('status') }}</small>
                    </div>
                @endif
                @csrf
                <label class="block">
                    <span class="text-gray-700 text-sm">Email</span>
                    <input type="email" name="email" placeholder="Masukan email"
                        class="form-input mt-1 block w-full py-2 px-4 border-gray-300 border rounded-md focus:border-green-600"
                        value="{{ old('email') }}">
                    @error('password')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </label>

                <label class="block mt-3">
                    <span class="text-gray-700 text-sm">Password</span>
                    <input type="password" name="password" placeholder="Masukan password"
                        class="form-input mt-1 block w-full py-2 px-4 border-gray-300 border rounded-md focus:border-green-600">
                    @error('password')
                        <small class="text-sm text-red-500">{{ $message }}</small>
                    @enderror
                </label>

                <div class="flex justify-between items-center mt-4">
                    <div>
                        <label class="inline-flex items-center">
                            <input name="remember" type="checkbox" class="form-checkbox text-green-600" value="true">
                            <span class="mx-2 text-gray-600 text-sm">Remember me</span>
                        </label>
                    </div>
                </div>

                <div class="mt-6">
                    <button
                        class="py-2 px-4 text-center bg-green-600 rounded-md w-full text-white text-sm hover:bg-green-500">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
