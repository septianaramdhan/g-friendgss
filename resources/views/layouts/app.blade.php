<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>G-Friend</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-purple-700 to-pink-500 text-white p-5">

        <h1 class="text-2xl font-bold mb-8">G-Friend</h1>

        <ul class="space-y-3">

            <!-- SUPER ADMIN -->
            @if(auth()->user()->role == 'superadmin')

                <li>
                    <a href="{{ route('super.dashboard') }}" class="block hover:bg-white/20 p-2 rounded">
                        Dashboard
                    </a>
                </li>

                <!-- DROPDOWN KELOLA USER -->
                <li>
              <button onclick="toggleUserMenu()" 
    class="w-full text-left p-2 rounded flex justify-between items-center
    {{ request()->routeIs('super.index') || request()->routeIs('super.create') || request()->routeIs('super.edit') 
       ? 'bg-white/30 font-semibold' 
       : 'hover:bg-white/20' }}">
    
    Kelola User

    <svg id="userIcon"
        class="w-4 h-4 transition-transform duration-300
        {{ request()->routeIs('super.index') || request()->routeIs('super.create') || request()->routeIs('super.edit') 
           ? 'rotate-90' 
           : '' }}"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M9 5l7 7-7 7" />
    </svg>
</button>

                   <ul id="userMenu" class="ml-4 mt-2 space-y-2 hidden">
                        <li>
                           <a href="{{ route('super.index') }}"
   class="block p-2 rounded
   {{ request()->routeIs('super.index') 
      ? 'bg-white/30 font-semibold' 
      : 'hover:bg-white/20' }}">
   List User
</a>
                        </li>
                        <li>
                            <a href="{{ route('super.create') }}"
   class="block p-2 rounded
   {{ request()->routeIs('super.create') 
      ? 'bg-white/30 font-semibold' 
      : 'hover:bg-white/20' }}">
   Tambah User
</a>
                        </li>
                    </ul>
                </li>

                <li>

                 <button onclick="toggleLaporanMenu()" 
    class="w-full text-left p-2 rounded flex justify-between items-center
    {{ request()->routeIs('super.laporan.*') 
       ? 'bg-white/30 font-semibold' 
       : 'hover:bg-white/20' }}">
    
    Laporan

    <svg id="laporanIcon"
        class="w-4 h-4 transition-transform duration-300
        {{ request()->routeIs('super.laporan.*') 
           ? 'rotate-90' 
           : '' }}"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M9 5l7 7-7 7" />
    </svg>
</button>

                <ul id="laporanMenu" class="ml-4 mt-2 space-y-2 hidden">
                   <li>
                     <a href="{{ route('super.laporan.transaksi') }}" 
                         class="block p-2 rounded 
                         {{ request()->routeIs('super.laporan.transaksi') 
                         ? 'bg-white/30 font-semibold' 
                         : 'hover:bg-white/20' }}">
                         Laporan Transaksi
                     </a>
                   </li>

                   <li>
                     <a href="{{ route('super.laporan.pendapatan') }}" 
                         class="block p-2 rounded 
                         {{ request()->routeIs('super.laporan.pendapatan') 
                         ? 'bg-white/30 font-semibold' 
                         : 'hover:bg-white/20' }}">
                         Laporan Pendapatan
                     </a>
                   </li>

                   <li>
                     <a href="{{ route('super.laporan.transaksi') }}" 
                         class="block p-2 rounded 
                         {{ request()->routeIs('super.laporan.transaksi') 
                         ? 'bg-white/30 font-semibold' 
                         : 'hover:bg-white/20' }}">
                         Laporan Transaksi
                     </a>
                   </li>
                </ul>
            </li>

            @endif


            <!-- ADMIN -->
            @if(auth()->user()->role == 'admin')

                <li>
                    <a href="/admin/dashboard" class="block hover:bg-white/20 p-2 rounded">
                        Dashboard
                    </a>
                </li>

                <!-- DROPDOWN KELOLA BARANG -->
                <li>
                    <button onclick="toggleBarangMenu()" 
                        class="w-full text-left hover:bg-white/20 p-2 rounded flex justify-between items-center">
                        Kelola Barang
                        <span>▼</span>
                    </button>

                    <ul id="barangMenu" class="ml-4 mt-2 space-y-2 hidden">
                        <li>
                            <a href="/barang" class="block hover:bg-white/20 p-2 rounded">
                                List Barang
                            </a>
                        </li>
                        <li>
                            <a href="/barang/create" class="block hover:bg-white/20 p-2 rounded">
                                Tambah Barang
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#" class="block hover:bg-white/20 p-2 rounded">
                        Laporan
                    </a>
                </li>

            @endif


            <!-- KASIR -->
            @if(auth()->user()->role == 'operator')

                <li>
                    <a href="/kasir/dashboard" class="block hover:bg-white/20 p-2 rounded">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="#" class="block hover:bg-white/20 p-2 rounded">
                        Transaksi
                    </a>
                </li>

                <li>
                    <a href="#" class="block hover:bg-white/20 p-2 rounded">
                        Cetak Struk
                    </a>
                </li>

            @endif

        </ul>

        <div class="mt-10">
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit"
                    class="w-full bg-white/20 hover:bg-white/30 p-2 rounded text-left">
                    Logout
                </button>
            </form>
        </div>

    </aside>


    <!-- Content -->
    <main class="flex-1 p-6 overflow-y-auto">

        <!-- Navbar -->
        <div class="bg-white p-4 rounded shadow mb-6 flex justify-between">
            <h2 class="font-bold text-lg">@yield('title')</h2>

            <div>
                Halo, {{ auth()->user()->name }}
            </div>
        </div>

        @yield('content')

    </main>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const userMenu = document.getElementById('userMenu');
    const userIcon = document.getElementById('userIcon');

    const laporanMenu = document.getElementById('laporanMenu');
    const laporanIcon = document.getElementById('laporanIcon');

    // ===== RESTORE STATE SAAT PAGE LOAD =====
    if (localStorage.getItem("userMenuOpen") === "true") {
        userMenu.classList.remove('hidden');
        userIcon.classList.add('rotate-90');
    }

    if (localStorage.getItem("laporanMenuOpen") === "true") {
        laporanMenu.classList.remove('hidden');
        laporanIcon.classList.add('rotate-90');
    }

    // ===== TOGGLE USER =====
    window.toggleUserMenu = function () {
        userMenu.classList.toggle('hidden');
        userIcon.classList.toggle('rotate-90');

        const isOpen = !userMenu.classList.contains('hidden');
        localStorage.setItem("userMenuOpen", isOpen);
    };

    // ===== TOGGLE LAPORAN =====
    window.toggleLaporanMenu = function () {
        laporanMenu.classList.toggle('hidden');
        laporanIcon.classList.toggle('rotate-90');

        const isOpen = !laporanMenu.classList.contains('hidden');
        localStorage.setItem("laporanMenuOpen", isOpen);
    };

});
</script>

</body>
</html>