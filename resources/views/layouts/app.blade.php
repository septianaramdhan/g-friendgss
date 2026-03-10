<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-Friend</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex h-screen">

    <aside class="w-64 bg-gradient-to-b from-purple-700 to-pink-500 text-white p-5 flex flex-col">

        <h1 class="text-2xl font-bold mb-8 text-center border-b border-white/20 pb-4">G-Friend</h1>

        <ul class="space-y-3 flex-1 overflow-y-auto">

            @if(auth()->user()->role == 'superadmin')

                <li>
                    <a href="{{ route('super.dashboard') }}" 
                       class="block p-3 rounded transition {{ request()->routeIs('super.dashboard') ? 'bg-white/30 font-semibold' : 'hover:bg-white/20' }}">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('super.index') }}" 
                       class="block p-3 rounded transition {{ request()->routeIs('super.index') || request()->routeIs('super.create') || request()->routeIs('super.edit') ? 'bg-white/30 font-semibold' : 'hover:bg-white/20' }}">
                        Kelola User
                    </a>
                </li>

                <li>
                    <a href="/super/barang" 
                       class="block p-3 rounded transition {{ request()->is('super/barang*') ? 'bg-white/30 font-semibold' : 'hover:bg-white/20' }}">
                        Kelola Barang
                    </a>
                </li>

                <li>
                    <a href="/super/diskon" 
                       class="block p-3 rounded transition {{ request()->is('super/diskon*') ? 'bg-white/30 font-semibold' : 'hover:bg-white/20' }}">
                        Kelola Diskon
                    </a>
                </li>

                <li>
                    <button onclick="toggleLaporanMenu()" 
                        class="w-full text-left p-3 rounded flex justify-between items-center transition
                        {{ request()->routeIs('super.laporan.*') ? 'bg-white/30 font-semibold' : 'hover:bg-white/20' }}">
                        Laporan
                        <svg id="laporanIcon" class="w-4 h-4 transition-transform duration-300 {{ request()->routeIs('super.laporan.*') ? 'rotate-90' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <ul id="laporanMenu" class="ml-4 mt-2 space-y-2 hidden border-l border-white/30 pl-2">
                        <li><a href="{{ route('super.laporan.transaksi') }}" class="block p-2 rounded hover:bg-white/20 text-sm">Laporan Transaksi</a></li>
                        <li><a href="{{ route('super.laporan.pendapatan') }}" class="block p-2 rounded hover:bg-white/20 text-sm">Laporan Pendapatan</a></li>
                        <li><a href="{{ route('super.laporan.stok') }}" class="block p-2 rounded hover:bg-white/20 text-sm">Laporan Stok</a></li>
                    </ul>
                </li>

            @endif

            @if(auth()->user()->role == 'admin')
                <li><a href="/admin/dashboard" class="block p-3 hover:bg-white/20 rounded">Dashboard</a></li>
                <li><a href="/barang" class="block p-3 hover:bg-white/20 rounded">Kelola Barang</a></li>
                <li><a href="#" class="block p-3 hover:bg-white/20 rounded">Laporan</a></li>
            @endif

            @if(auth()->user()->role == 'operator')
                <li><a href="/kasir/dashboard" class="block p-3 hover:bg-white/20 rounded">Dashboard</a></li>
                <li><a href="#" class="block p-3 hover:bg-white/20 rounded">Transaksi</a></li>
                <li><a href="#" class="block p-3 hover:bg-white/20 rounded">Cetak Struk</a></li>
            @endif

        </ul>

        <div class="mt-auto pt-5 border-t border-white/20">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-white/10 hover:bg-red-500 transition p-3 rounded text-left flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <main class="flex-1 p-6 overflow-y-auto">

        <div class="bg-white p-4 rounded shadow-sm mb-6 flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-700">@yield('title')</h2>
            <div class="text-gray-600 flex items-center gap-2">
                <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-1 rounded uppercase">{{ auth()->user()->role }}</span>
                <span>Halo, <span class="font-bold text-purple-700">{{ auth()->user()->name }}</span></span>
            </div>
        </div>

        @yield('content')

    </main>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const laporanMenu = document.getElementById('laporanMenu');
    const laporanIcon = document.getElementById('laporanIcon');

    // Hanya laporan yang menggunakan dropdown & restore state
    if (localStorage.getItem("laporanMenuOpen") === "true") {
        laporanMenu?.classList.remove('hidden');
        laporanIcon?.classList.add('rotate-90');
    }

    window.toggleLaporanMenu = function () {
        if (laporanMenu) {
            laporanMenu.classList.toggle('hidden');
            laporanIcon.classList.toggle('rotate-90');
            localStorage.setItem("laporanMenuOpen", !laporanMenu.classList.contains('hidden'));
        }
    };
});
</script>

</body>
</html>