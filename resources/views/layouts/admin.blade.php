<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Admin | Smoke Paradise</title>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="{{ asset('images/logo2.png') }}" rel="icon">
<link href="{{ asset('images/logo2.png') }}" rel="apple-touch-icon">

<style>
    /* Background clair avec nuages vape léger */
    body {
        font-family: 'Inter', sans-serif;
        background: #fff7ed; /* ton clair orangé */
        overflow-x: hidden;
        position: relative;
    }

    .vape-cloud {
        position: absolute;
        background: radial-gradient(circle, rgba(249,115,22,0.08) 0%, transparent 70%);
        width: 250px;
        height: 250px;
        border-radius: 50%;
        animation: float 40s linear infinite;
        pointer-events: none;
        z-index: 0;
    }

    .vape-cloud:nth-child(1) { top: 5%; left: 10%; animation-duration: 35s; }
    .vape-cloud:nth-child(2) { top: 30%; left: 70%; animation-duration: 50s; }
    .vape-cloud:nth-child(3) { top: 50%; left: 30%; animation-duration: 45s; }
    .vape-cloud:nth-child(4) { top: 15%; left: 50%; animation-duration: 60s; }

    @keyframes float {
        0% { transform: translateY(0) scale(1); opacity: 0.05; }
        50% { transform: translateY(-50vh) scale(1.3); opacity: 0.1; }
        100% { transform: translateY(-100vh) scale(1.6); opacity: 0; }
    }

    /* Glow léger pour les boutons et sidebar */
    .orange-glow {
        box-shadow: 0 0 10px rgba(249,115,22,0.4);
    }
</style>
</head>
<body class="text-gray-900 relative">

<!-- Nuages animés -->
<div class="vape-cloud"></div>
<div class="vape-cloud"></div>
<div class="vape-cloud"></div>
<div class="vape-cloud"></div>

<div class="flex min-h-screen relative z-10">

    <!-- Sidebar -->
    <aside class="w-64 bg-white/90 backdrop-blur-md shadow-lg flex flex-col justify-between z-20 rounded-r-3xl orange-glow">
        <div>
            <div class="p-6 text-2xl font-bold text-orange-500 tracking-wide text-center drop-shadow-sm">
                Smoke Paradise
            </div>

            <nav class="mt-6 space-y-3 px-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-orange-100 text-gray-900 font-semibold transition duration-300 hover:scale-105">
                    <i data-feather="home" class="text-orange-500"></i> Dashboard
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-orange-100 text-gray-900 font-semibold transition duration-300 hover:scale-105">
                    <i data-feather="package" class="text-orange-500"></i> Produits
                </a>
                <a href="{{ route('admin.flavors.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-orange-100 text-gray-900 font-semibold transition duration-300 hover:scale-105">
                    <i data-feather="tag" class="text-orange-500"></i> Arômes
                </a>
               
            </nav>
        </div>

        <!-- Déconnexion -->
        <div class="p-6 border-t border-orange-200">
            <button onclick="logoutModal()"
                    class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl bg-gradient-to-r from-orange-400 to-orange-500 text-white font-bold shadow-md hover:from-orange-500 hover:to-orange-600 transition transform hover:scale-105">
                <i data-feather="log-out"></i> Déconnecter
            </button>
        </div>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-10 overflow-y-auto">
        @yield('content')
    </main>
</div>

<!-- Logout Modal -->
<div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-3xl shadow-lg p-8 max-w-sm w-full border-l-4 border-orange-400">
        <h2 class="text-xl font-bold mb-4 text-orange-500 flex items-center gap-2">
            <i data-feather="alert-circle"></i> Déconnexion
        </h2>
        <p class="text-gray-900 mb-6">Êtes-vous sûr de vouloir vous déconnecter ?</p>
        <div class="flex justify-end gap-3">
            <button onclick="closeLogoutModal()"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-900 hover:bg-gray-100 transition">
                Annuler
            </button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white font-bold transition transform hover:scale-105">
                    Déconnecter
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    feather.replace();
    function logoutModal() { document.getElementById('logoutModal').classList.remove('hidden'); }
    function closeLogoutModal() { document.getElementById('logoutModal').classList.add('hidden'); }
</script>
</body>
</html>
