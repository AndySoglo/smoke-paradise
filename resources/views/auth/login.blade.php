<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Smoke Paradise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom gradient for Smoke Paradise branding */
        .bg-sp-gradient {
            background: linear-gradient(135deg, #f97316, #f59e0b);
        }
    </style>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen font-sans">

    <div class="w-full max-w-md bg-gray-800 rounded-3xl shadow-2xl p-8">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <div class="w-16 h-16 rounded-full bg-gray-900 flex items-center justify-center shadow-lg overflow-hidden">
                <img src="/images/logo1.png" alt="Smoke Paradise Logo" class="w-full h-full object-cover">
            </div>
        </div>

        <h1 class="text-3xl font-extrabold text-center text-white mb-6">Smoke Paradise</h1>

        <!-- Session Status -->
        @if (session('status'))
            <div class="bg-orange-600 text-white p-3 rounded mb-4 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="w-full px-4 py-3 rounded-xl bg-gray-700 text-white placeholder-gray-400 focus:ring-orange-500 focus:border-orange-500 border border-gray-600 outline-none" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-orange-500 text-sm" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-3 rounded-xl bg-gray-700 text-white placeholder-gray-400 focus:ring-orange-500 focus:border-orange-500 border border-gray-600 outline-none" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-orange-500 text-sm" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="h-4 w-4 text-orange-500 focus:ring-orange-400 border-gray-600 rounded" />
                <label for="remember_me" class="ml-2 text-sm text-gray-300">Remember me</label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-orange-400 hover:text-orange-300 underline">
                        Forgot your password?
                    </a>
                @endif

                <button type="submit" class="bg-sp-gradient hover:from-orange-500 hover:to-orange-400 text-black font-bold px-6 py-3 rounded-xl shadow-lg transition-all duration-300">
                    Log in
                </button>
            </div>
        </form>

        <!-- Footer -->
        <p class="text-center text-gray-400 text-sm mt-6">© 2026 Smoke Paradise</p>
    </div>

</body>
</html>
