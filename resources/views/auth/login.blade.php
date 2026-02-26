<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login G-Friend</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: linear-gradient(270deg, #7c3aed, #a855f7, #ec4899);
            background-size: 600% 600%;
            animation: gradient 12s ease infinite;
        }

        @keyframes gradient {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">

    <div class="bg-white/20 backdrop-blur-lg shadow-xl rounded-2xl p-8 w-96 border border-white/30">

        <h2 class="text-2xl font-bold text-white text-center mb-6">
            G-Friend Login
        </h2>

        <form method="POST" action="/login">
            @csrf

            <div class="mb-4">
                <label class="text-white">Email</label>
                <input type="email" name="email"
                    class="w-full mt-1 p-2 rounded-lg bg-white/70 focus:outline-none">
            </div>

            <div class="mb-6">
                <label class="text-white">Password</label>
                <input type="password" name="password"
                    class="w-full mt-1 p-2 rounded-lg bg-white/70 focus:outline-none">
            </div>

            <button
                class="w-full bg-gradient-to-r from-purple-600 to-pink-500 text-white py-2 rounded-lg hover:scale-105 transition">
                Login
            </button>

        </form>

    </div>

</body>
</html>