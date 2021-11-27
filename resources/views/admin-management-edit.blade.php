@extends('_layouts.master')

@section('body')

    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">Edit Informasi</h2>
        <hr class="my-3">
        <form action="{{ route('admin.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mt-2">
                <label class="text-xs mb-1">Nama Lengkap</label>
                <input type="text" placeholder="Masukan nama lengkap" name="name"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ $user->name }}">
                @error('name')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Gambar</label>
                <label
                    class="input-file w-full rounded-md focus:border-green-600 border border-gray-400 inline-block px-4 py-2 cursor-pointer text-gray-400">
                    <input type="file" name="gambar" class="hidden">
                    <i class="fas fa-image fa-fw"></i>
                    <span id="file-placeholder" class="ml-2">klik untuk input gambar</span>
                </label>
                <style>
                    .input-file {
                        background-image: url("{{ asset('img/users/' . $user->gambar) }}");
                        background-position: center center;
                        background-size: cover;
                    }

                </style>
                @error('gambar')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Alamat Email</label>
                <input type="email" placeholder="Masukan alamat email" name="email"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ $user->email }}">
                @error('email')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <div class="flex">
                    <div class="w-1/2 pr-1">
                        <label class="text-xs mb-1">Password</label>
                        <input type="password" placeholder="Masukan password" name="password"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                        @error('password')
                            <small class="text-sm text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="w-1/2 pl-1">
                        <label class="text-xs mb-1">Confirm Password</label>
                        <input type="password" placeholder="Konfirmasi password" name="password_confirmation"
                            class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400">
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Save</button>
            </div>
        </form>
    </div>

    <script>
        let input = document.querySelector('.input-file')
        input.addEventListener("change", () => {
            path = input.childNodes[1].value.split(/(\\|\/)/g).pop()
            input.classList.remove('text-gray-400')
            input.classList.add('text-white')
            input.style.backgroundImage = `url('${URL.createObjectURL(input.childNodes[1].files[0])}')`
            input.childNodes[5].innerHTML = `${path} / ${humanFileSize(input.childNodes[1].files[0].size, 2)}`
        })
    </script>

@endsection
