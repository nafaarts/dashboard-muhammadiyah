<div id="sidebar"
    class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-white overflow-y-auto lg:translate-x-0 -translate-x-full lg:static lg:inset-0 shadow-lg flex flex-col justify-between">
    <div>
        <div class="flex items-center justify-center my-8">
            <img src="{{ asset('logo.png') }}" alt="Logo Muhammadiyah">
        </div>
        <hr>
        <nav>
            <a class="flex items-center mt-4 py-2 px-6 text-gray-600  hover:text-gray-800"
                href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span class="mx-3">Dashboard</span>
            </a>
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800"
                href="{{ route('profile') }}">
                <i class="fas fa-fw fa-id-badge"></i>
                <span class="mx-3">My Profile</span>
            </a>
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800"
                href="{{ route('informasi') }}">
                <i class="fas fa-fw fa-newspaper"></i>
                <span class="mx-3">Informasi</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800"
                href="{{ route('donasi') }}">
                <i class="fas fa-fw fa-hand-holding-heart"></i>
                <span class="mx-3">Donasi</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800"
                href="{{ route('galeri') }}">
                <i class="fas fa-fw fa-images"></i>
                <span class="mx-3">Galeri</span>
            </a>

            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800" href="{{ route('staff') }}">
                <i class="fas fa-fw fa-user-friends"></i>
                <span class="mx-3">Staff</span>
            </a>
            <a class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800" href="/admin-management">
                <i class="fas fa-fw fa-user-tie"></i>
                <span class="mx-3">Admin Management</span>
            </a>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:text-gray-800 w-full"><i
                        class="fas fa-fw fa-sign-out-alt"></i>
                    <span class="mx-3">Logout</span></button>
            </form>
        </nav>
    </div>
    <footer class="text-center mt-4">
        <hr>
        <a href="https://nafaarts.com" target="_blank">
            <div class="flex text-sm items-center justify-center py-10">
                <span class="text-gray-500">Powered by</span>
                <i class="mx-1">
                    <svg width="14" height="14" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="300" height="300" fill="#F7941E" />
                        <rect x="129" y="69" width="40" height="162" rx="20" fill="white" />
                        <rect x="226.768" y="115.232" width="31.4212" height="127.909" rx="2"
                            transform="rotate(44.632 226.768 115.232)" fill="white" />
                        <rect x="134.179" y="76.3133" width="32.0426" height="118.389" rx="2"
                            transform="rotate(44.632 134.179 76.3133)" fill="white" />
                    </svg>
                </i>
                <strong>Nafaarts</strong>
            </div>
        </a>
    </footer>
</div>
