@extends('_layouts.master')

@section('body')

    <div class="p-6 bg-white rounded-md shadow-md">
        <h2 class="text-lg text-gray-700 font-semibold capitalize">Add Donatur</h2>
        <hr class="my-3">
        <form action="{{ route('donatur.create', $donasi) }}" method="POST" enctype="multipart/form-data">
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
                <label class="text-xs mb-1">Email</label>
                <input type="text" placeholder="Masukan email" name="email"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ old('email') }}">
                @error('email')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="mt-2">
                <label class="text-xs mb-1">Jumlah</label>
                <input type="text" placeholder="Masukan jumlah donasi" name="jumlah"
                    class="form-input w-full px-4 py-2 appearance-none rounded-md focus:border-green-600 border border-gray-400"
                    value="{{ old('jumlah') }}">
                @error('jumlah')
                    <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">Save</button>
            </div>
        </form>
    </div>
@endsection
