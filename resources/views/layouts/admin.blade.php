<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin | Smoke Paradise</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        /* Light smoke animation */
        body {
            background: #fefaf4; /* ton clair */
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        .smoke {
            position: fixed;
            top: -200px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 80%);
            opacity: 0.05;
            border-radius: 50%;
            animation: float 25s linear infinite;
            pointer-events: none;
        }

        .smoke:nth-child(2) { left: 20%; animation-duration: 30s; opacity: 0.04; }
        .smoke:nth-child(3) { left: 50%; animation-duration: 35s; opacity: 0.03; }
        .smoke:nth-child(4) { left: 80%; animation-duration: 28s; opacity: 0.02; }

        @keyframes float {
            0% { transform: translateY(0) scale(1); opacity: 0.03; }
            50% { transform: translateY(50vh) scale(1.5); opacity: 0.05; }
            100% { transform: translateY(100vh) scale(2); opacity: 0; }
        }
    </style>
</head>
<body class="relative">

<!-- Smoke effect -->
<div class="smoke"></div>
<div class="smoke"></div>
<div class="smoke"></div>
<div class="smoke"></div>

<div class="flex min-h-screen relative z-10">

    <!-- Sidebar moderne -->
    <aside class="w-64 bg-gradient-to-b from-orange-100 via-orange-50 to-white shadow-lg flex flex-col justify-between">
        <div>
            <div class="p-6 text-2xl font-bold text-orange-600 tracking-wide text-center">
                Smoke Paradise
            </div>

            <nav class="mt-6 space-y-2 px-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-orange-100 text-gray-700 font-semibold transition">
                    <i data-feather="home" class="text-orange-500"></i> Dashboard
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-orange-100 text-gray-700 font-semibold transition">
                    <i data-feather="package" class="text-orange-500"></i> Produits
                </a>

                <a href="{{ route('admin.flavors.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-orange-100 text-gray-700 font-semibold transition">
                    <i data-feather="tag" class="text-orange-500"></i> Arômes
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-orange-100 text-gray-700 font-semibold transition">
                    <i data-feather="shopping-cart" class="text-orange-500"></i> Commandes
                </a>
            </nav>
        </div>

        <!-- Bouton Déconnexion -->
        <div class="p-6 border-t border-orange-200">
            <button onclick="logoutModal()"
                    class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold shadow-lg hover:from-orange-500 hover:to-orange-600 transition">
                <i data-feather="log-out"></i> Déconnecter
            </button>
        </div>
    </aside>

    <!-- Contenu principal -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>



</div>

<!-- Modal Déconnexion -->
<div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-3xl shadow-2xl p-8 max-w-sm w-full border-l-4 border-orange-400">
        <h2 class="text-xl font-bold mb-4 text-gray-800 flex items-center gap-2">
            <i data-feather="alert-circle" class="text-orange-500"></i> Déconnexion
        </h2>
        <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir vous déconnecter ?</p>
        <div class="flex justify-end gap-3">
            <button onclick="closeLogoutModal()"
                    class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                Annuler
            </button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white font-semibold transition">
                    Déconnecter
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    feather.replace();

    function logoutModal() {
        document.getElementById('logoutModal').classList.remove('hidden');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.add('hidden');
    }
</script>

</body>
</html>
