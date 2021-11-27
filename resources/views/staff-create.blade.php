@extends('_layouts.master')

@section('body')

    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">Add Staff</h2>
        <hr class="my-3">
        <form action="{{ route('staff.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mt-2">
                <label class="text-xs mb-1">Nama Lengkap</label>
                <input type="text" placeholder="Masukan nama lengkap" name="name"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ old('name') }}">
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
                        background-position: center center;
                        background-size: cover;
                    }

                </style>
                @error('gambar')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Jabatan</label>
                <input type="text" placeholder="Masukan jabatan" name="jabatan"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ old('jabatan') }}">
                @error('jabatan')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">No. Telepon</label>
                <input type="text" placeholder="Masukan nomor telepon" name="phone"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ old('phone') }}">
                @error('phone')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
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
