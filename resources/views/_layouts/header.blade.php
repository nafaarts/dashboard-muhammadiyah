<header class="flex justify-between items-center py-4 px-6 bg-white shadow-lg">
    <h2 class="text-xl text-gray-500 font-semibold">#{{ $title }}</h2>
    <div class="flex items-center">

        <div class="relative">
            <div class="profile-navbar flex items-center">
                <h3 class="text-sm text-gray-500">{{ auth()->user()->name }}</h3>
                <button
                    class="ml-4 relative block h-8 w-8 border rounded-full overflow-hidden shadow-md focus:outline-none">
                    <img class="h-full w-full object-cover" src="{{ asset('img/users/' . auth()->user()->gambar) }}">
                </button>
            </div>

            {{-- <div class="fixed inset-0 bg-gray-500 h-full w-full z-10"></div> --}}

            <div class="absolute hidden right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
                <a href="#"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Profile</a>

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">Logout</button>
                </form>
            </div>
        </div>
    </div>
</header>
