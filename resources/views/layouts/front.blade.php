<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smoke Paradise @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #smokeCanvas {
            position: fixed;
            top:0; left:0;
            width:100%; height:100%;
            pointer-events:none;
            z-index:-10;
            opacity: 0.6;
        }
    </style>
</head>
<body class="bg-orange-50/40 min-h-screen flex flex-col relative">

    <!-- Canvas fumée en arrière-plan -->
    <canvas id="smokeCanvas"></canvas>

    <!-- NAVBAR -->
    <nav class="bg-white/90 backdrop-blur-md shadow-md fixed w-full z-50 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-xl">
                        SP
                    </div>
                    <span class="text-xl md:text-2xl font-bold text-orange-600">Smoke Paradise</span>
                </a>

                <!-- Liens -->
                <div class="hidden md:flex items-center space-x-10">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-600 font-medium transition">Accueil</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-orange-600 font-medium transition">Produits</a>
                    <!-- Tu pourras ajouter Contact, À propos, etc. plus tard -->
                </div>


                
            </div>
        </div>
    </nav>

    <!-- Espace pour le navbar fixe -->
    <div class="h-16 md:h-20"></div>

    <!-- Contenu principal -->
    <main class="flex-grow z-10 relative">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gradient-to-t from-orange-900 to-orange-800 text-orange-100 pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10">

            <!-- Colonne 1 - Logo & description -->
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-orange-600 font-bold text-2xl shadow-lg">
                        SP
                    </div>
                    <span class="text-2xl font-bold text-white">Smoke Paradise</span>
                </div>
                <p class="text-orange-200 text-sm leading-relaxed">
                    Votre boutique de référence pour des produits de vapotage de qualité premium au Bénin.
                </p>
            </div>

            <!-- Colonne 2 - Liens rapides -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-5">Liens rapides</h4>
                <ul class="space-y-3 text-orange-200 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Accueil</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-white transition">Nos produits</a></li>

                </ul>
            </div>

            <!-- Colonne 3 - Contact -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-5">Contact</h4>
                <ul class="space-y-3 text-sm text-orange-200">
                    <li>📞 +229 XX XX XX XX</li>
                    <li>✉️ contact@smokeparadise.bj</li>
                    <li>📍 Abomey-Calavi / Cotonou</li>
                </ul>
            </div>

            <!-- Colonne 4 - Réseaux & mentions -->
            <div>
                <h4 class="text-lg font-semibold text-white mb-5">Suivez-nous</h4>
                <div class="flex space-x-5 mb-6">
                    <a href="#" class="text-2xl hover:text-white transition">FB</a>
                    <a href="#" class="text-2xl hover:text-white transition">IG</a>
                    <a href="#" class="text-2xl hover:text-white transition">WA</a>
                </div>
                <p class="text-xs text-orange-300">
                    © {{ date('Y') }} Smoke Paradise. Tous droits réservés.<br>
                    <a href="#" class="underline hover:text-white">Mentions légales</a> •
                    <a href="#" class="underline hover:text-white">Politique de confidentialité</a>
                </p>
            </div>

        </div>
    </footer>

    <!-- Script fumée (légèrement ajusté pour mieux s'intégrer) -->
    <script>
    const canvas = document.getElementById('smokeCanvas');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        });

        class Particle {
            constructor() { this.reset(); }
            reset() {
                this.x = Math.random() * canvas.width;
                this.y = canvas.height + Math.random() * 150;
                this.radius = 25 + Math.random() * 40;
                this.speed = 0.4 + Math.random() * 0.8;
                this.alpha = 0.04 + Math.random() * 0.06;
            }
            update() {
                this.y -= this.speed;
                this.x += Math.sin(this.y * 0.008) * 0.7;
                this.alpha -= 0.0004;
                if (this.alpha <= 0) this.reset();
            }
            draw() {
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(220,220,220,${this.alpha})`;
                ctx.fill();
            }
        }

        let particles = [];
        for(let i = 0; i < 60; i++) particles.push(new Particle());

        function animate() {
            ctx.clearRect(0,0,canvas.width,canvas.height);
            particles.forEach(p => { p.update(); p.draw(); });
            requestAnimationFrame(animate);
        }
        animate();
    }
    </script>

</body>
</html>
