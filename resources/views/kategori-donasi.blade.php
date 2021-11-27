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
    <form action="{{ route('kategori-donasi.store') }}" method="POST">
        @csrf
        <div class="flex">
            <div class="w-5/6">
                <input type="text" placeholder="Masukan kategori baru" name="kategori"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md shadow" value="{{ old('kategori') }}">
                @error('kategori')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="w-1/6 pl-2">
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700 w-full">Add
                    Category</button>
            </div>
        </div>
    </form>
    <div class="bg-yellow-100 rounded-lg p-4 mt-4 text-sm text-yellow-700 shadow" role="alert">
        <div>
            <i class="fas fa-fw fa-info-circle"></i>
            <span class="font-medium">Peringatan!</span> Kategori tidak bisa dihapus jika terdapat donasi.
        </div>
    </div>
    <div class="bg-white shadow rounded-md overflow-hidden mt-4">
        <table class="text-left w-full border-collapse">
            <thead class="border-b">
                <tr>
                    <th class="py-3 px-5 bg-gray-50 font-medium uppercase text-sm text-gray-500">Kategori</th>
                    <th class="py-3 px-5 bg-gray-50 font-medium uppercase text-sm text-gray-500">Jumlah Donasi</th>
                    <th class="py-3 px-5 bg-gray-50 font-medium uppercase text-sm text-gray-500">Created At</th>
                    <th class="py-3 px-5 bg-gray-50 font-medium uppercase text-sm text-gray-500">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr class="hover:bg-gray-50 kategori-row">
                        <td class="py-4 px-6 border-b text-gray-700 text-lg font-bold">{{ $item->kategori }}</td>
                        <td class="py-4 px-6 border-b text-gray-500 text-sm"><strong>{{ $item->donasi->count() }}</strong>
                            donasi terdaftar</td>
                        <td class="py-4 px-6 border-b text-gray-500">{{ $item->created_at->diffForHumans() }}</td>
                        <td class="py-4 px-6 border-b text-gray-500">
                            <button data-id="{{ $item->id }}" id="edit" class="text-gray-600 hover:text-gray-900"><i
                                    class="fas fa-fw fa-edit"></i></button>
                            @if (!$item->donasi->count())
                                <form action="{{ route('kategori-donasi.delete', $item->id) }}" method="POST"
                                    onsubmit="return confirmDelete(this)"
                                    class="delete-confirm text-gray-600 hover:text-gray-900 inline">
                                    @method('DELETE')
                                    @csrf
                                    <button><i class="fas fa-fw fa-trash"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        let row = document.querySelectorAll('.kategori-row')
        let el = document.createElement("tr");
        row.forEach(element => {
            element.childNodes[7].childNodes[1].addEventListener('click', (e) => {
                let ID = element.childNodes[7].childNodes[1].dataset.id;
                console.log(ID)
                let el2 = `<td colspan="4" class="py-4 px-6 border-b text-gray-700 bg-gray-50">
                    <form action="{{ route('kategori-donasi.update') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="${ID}">
                        <div class="flex">
                            <div class="w-5/6">
                                <input type="text" placeholder="Masukan kategori" name="kategori"
                                    class="w-full px-2 py-1 appearance-none rounded-md border text-sm" value="${element.childNodes[1].textContent}">
                            </div>
                            <div class="w-1/6 pl-2">
                                <button type="submit"
                                    class="px-2 py-1 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700 w-full text-sm">Edit
                                    Category</button>
                            </div>
                        </div>
                    </form>
                    </td>`
                el.innerHTML = el2
                insertAfter(element, el)
            })
        });

        function insertAfter(referenceNode, newNode) {
            referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
        }
    </script>
@endsection
