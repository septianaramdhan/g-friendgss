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
                <li><a href="/super/dashboard" class="block hover:bg-white/20 p-2 rounded">Dashboard</a></li>
                <li><a href="/users" class="block hover:bg-white/20 p-2 rounded">Kelola User</a></li>
                <li><a href="#" class="block hover:bg-white/20 p-2 rounded">Laporan</a></li>
            @endif


            <!-- ADMIN -->
            @if(auth()->user()->role == 'admin')
                <li><a href="/admin/dashboard" class="block hover:bg-white/20 p-2 rounded">Dashboard</a></li>
                <li><a href="#" class="block hover:bg-white/20 p-2 rounded">Barang</a></li>
                <li><a href="#" class="block hover:bg-white/20 p-2 rounded">Laporan</a></li>
            @endif


            <!-- KASIR -->
            @if(auth()->user()->role == 'kasir')
                <li><a href="/kasir/dashboard" class="block hover:bg-white/20 p-2 rounded">Dashboard</a></li>
                <li><a href="#" class="block hover:bg-white/20 p-2 rounded">Transaksi</a></li>
                <li><a href="#" class="block hover:bg-white/20 p-2 rounded">Cetak Struk</a></li>
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

</body>
</html>