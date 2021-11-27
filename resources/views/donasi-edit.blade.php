@extends('_layouts.master')

@section('body')

    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">Edit Informasi</h2>
        <hr class="my-3">
        <form action="{{ route('donasi.update', $donasi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mt-2">
                <label class="text-xs mb-1">Judul Donasi</label>
                <input type="text" placeholder="Masukan judul donasi" name="judul"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ $donasi->judul }}">
                @error('judul')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Jumlah target Donasi</label>
                <input type="text" placeholder="Masukan jumlah target donasi" name="target"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ $donasi->target }}">
                @error('target')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Kategori Donasi</label>
                <select name="kategori"
                    class="form-select w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400 capitalize">
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                    @endforeach
                </select>
                <script>
                    document.querySelector('.form-select').value = "{{ $donasi->kategori }}"
                </script>
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
                        background-image: url("{{ asset('img/donasi/' . $donasi->gambar) }}");
                        background-position: center center;
                        background-size: cover;
                    }

                </style>
                @error('gambar')
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
