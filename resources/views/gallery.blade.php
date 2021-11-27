@extends('_layouts.master')

@section('body')
    @if (session('status'))
        <script>
            Swal.fire({
                title: 'Good job!',
                text: "{{ session('status') }}",
                icon: 'success',
                confirmButtonColor: '#047857',
            })
        </script>
    @endif
    <div class="flex flex-wrap -m-4">
        @foreach ($data as $item)
            <div class="lg:w-1/3 sm:w-1/2 p-4 ">
                <div class="flex relative">
                    <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center"
                        src="{{ asset('img/gallery/medium/' . $item->gambar) }}">
                    <div
                        class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100">
                        <p class="leading-relaxed">{{ $item->deskripsi }}</p>
                        <h5 class="text-gray-500 text-sm mt-3">{{ $item->created_at->diffForHumans() }}</h5>
                        <hr class="my-8">
                        <form onsubmit="return confirmDelete(this)" action="{{ route('galeri.delete', $item) }}"
                            method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="text-gray-600 hover:text-gray-800"><i class="fas fa-fw fa-trash"></i>
                                Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ route('galeri.create') }}"
        class="z-50 cursor-pointer fixed bottom-8 right-8 flex rounded-full bg-green-700 hover:bg-green-800 justify-center items-center w-14 h-14 text-white">
        <h1 class="text-3xl"><i class="fas fa-fw fa-add"></i></h1>
    </a>

@endsection
