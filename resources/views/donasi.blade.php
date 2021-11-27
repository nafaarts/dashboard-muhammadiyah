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
    <div class="flex flex-col">
        <div class="flex justify-between mb-5">
            <a href="{{ route('donasi.create') }}" type="button"
                class="bg-green-700 text-white rounded-md text-sm py-1 px-4"><i class="fas fa-fw fa-add"></i> Tambah
                Donasi</a>
            <a href="{{ route('kategori-donasi') }}" class="bg-gray-600 text-white rounded-md text-sm py-1 px-4"><i
                    class="fas fa-fw fa-list"></i>
                Kategori Donasi</a>
        </div>
        <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 mb-5">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Image</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Title</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Target/Jumlah</th>

                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Donatur</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Category</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Updated At</th>
                            <th
                                class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($data as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full"
                                                src="{{ asset('img/donasi/' . $item->gambar) }}" alt="" />
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900 overflow-hidden truncate"
                                        style="width: 180px">
                                        {{ $item->judul }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">Rp {{ number_format($item->target, 2) }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">Rp {{ number_format($item->jumlah, 2) }}
                                    </div>
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500 cursor-pointer font-bold">
                                    <a href="{{ route('donatur', $item) }}"
                                        class="text-gray-600 hover:text-gray-900">{{ $item->donatur->count() }}<i
                                            class="fas fa-fw fa-users ml-2"></i></a>
                                </td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    {{ $item->categories->kategori }}</td>

                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                                    {{ $item->updated_at->diffForHumans() }}</td>
                                <td
                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium">

                                    <a href="{{ route('donasi.edit', $item) }}"
                                        class="text-gray-600 hover:text-gray-900"><i class="fas fa-fw fa-edit"></i></a>
                                    <form action="{{ route('donasi.delete', $item) }}" method="POST"
                                        class="inline" onsubmit="return confirmDelete(this)">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-gray-600 hover:text-gray-900"><i
                                                class="fas fa-fw fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $data->links() }}
        </div>
    </div>
@endsection
