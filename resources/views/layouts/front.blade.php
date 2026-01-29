<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smoke Paradise @yield('title')</title>
    <link href="{{ asset('images/logo2.png') }}" rel="icon">
    <link href="{{ asset('images/logo2.png') }}" rel="apple-touch-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        #smokeCanvas{
            position: fixed;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -10;
            opacity: 0.6;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-orange-950 via-black to-orange-900 min-h-screen flex flex-col text-gray-100 overflow-x-hidden relative">

<!-- ================= SMOKE CANVAS ================= -->
<canvas id="smokeCanvas"></canvas>

<!-- ================= NAVBAR ================= -->
<nav class="fixed top-0 w-full z-50 bg-black/50 backdrop-blur-xl border-b border-orange-500/20 shadow-[0_0_30px_rgba(249,115,22,0.25)]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16 md:h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="relative group">
                <!-- Glow derrière le logo -->
                <div class="absolute inset-0 rounded-full bg-orange-500 blur-lg opacity-60 group-hover:opacity-100 transition"></div>

                <!-- Logo -->
                <div class="relative w-11 h-11 rounded-full bg-black flex items-center justify-center overflow-hidden border border-orange-400/40">
                    <img
                        src="{{ asset('images/logo1.png') }}"
                        alt="Smoke Paradise Logo"
                        class="w-full h-full object-contain p-1"
                    >
                </div>
            </div>

                <span class="text-xl md:text-2xl font-black tracking-wide text-orange-400 group-hover:text-orange-300 transition">
                    Smoke Paradise
                </span>
            </a>

            <!-- Links -->
            <div class="hidden md:flex items-center gap-10">
                <a href="{{ route('home') }}"
                   class="relative text-gray-300 hover:text-orange-400 transition after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-0 after:bg-orange-500 after:transition-all hover:after:w-full">
                    Accueil
                </a>
                <a href="{{ route('products.index') }}"
                   class="relative text-gray-300 hover:text-orange-400 transition after:absolute after:left-0 after:-bottom-1 after:h-[2px] after:w-0 after:bg-orange-500 after:transition-all hover:after:w-full">
                    Produits
                </a>
            </div>

        </div>
    </div>
</nav>

<!-- Spacer navbar -->
<div class="h-16 md:h-20"></div>

<!-- ================= HERO CINÉMATIQUE ================= -->


<!-- ================= MAIN ================= -->
<main class="relative flex-grow z-10">
    @yield('content')
</main>

<!-- ================= FOOTER ================= -->
<footer class="relative bg-black pt-20 pb-10 text-orange-100 overflow-hidden">

    <!-- Glow background -->
    <div class="absolute inset-0 bg-gradient-to-t from-orange-600/20 via-transparent to-transparent blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6">

        <!-- TOP -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-14">

            <!-- BRAND -->
            <div>
               <div class="flex items-center gap-4 mb-6">
    <!-- Logo -->
    <div class="relative group">
        <!-- Glow derrière -->
        <div class="absolute inset-0 rounded-full bg-orange-500 blur-2xl opacity-70 group-hover:opacity-100 transition"></div>

        <!-- Contour gradient -->
        <div class="relative w-16 h-16 md:w-18 md:h-18 rounded-full p-[3px] bg-gradient-to-br from-orange-400 to-orange-600 shadow-[0_0_35px_rgba(249,115,22,0.8)]">
            <div class="w-full h-full rounded-full bg-black flex items-center justify-center overflow-hidden">
                <img
                    src="{{ asset('images/logo1.png') }}"
                    alt="Smoke Paradise Logo"
                    class="w-full h-full object-contain p-2 scale-105"
                >
            </div>
        </div>
    </div>

    <!-- Texte -->
    <span class="text-2xl md:text-3xl font-extrabold tracking-wide text-orange-200">
        Smoke Paradise
    </span>
</div>


                <p class="text-sm text-orange-200 leading-relaxed">
                    Boutique premium de vapotage au Bénin.
                    Produits authentiques, saveurs intenses et expérience street & lifestyle.
                </p>
            </div>

            <!-- NAVIGATION -->
            <div>
                <h4 class="font-bold text-lg mb-5 text-orange-300">Navigation</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="/" class="hover:text-orange-400 transition">Accueil</a></li>
                    <li><a href="/produits" class="hover:text-orange-400 transition">Produits</a></li>

                </ul>
            </div>

            <!-- INFORMATIONS -->
            <div>
                <h4 class="font-bold text-lg mb-5 text-orange-300">Informations</h4>
                <ul class="space-y-3 text-sm">
                    <li><span class="text-orange-400">📍</span> Bénin</li>
                    <li><span class="text-orange-400">🕒</span> Lun - Sam : 9h - 20h</li>
                    <li><span class="text-orange-400">⚠️</span> Vente interdite aux mineurs</li>
                </ul>
            </div>

            <!-- CONTACT / SOCIAL -->
            <div>
                <h4 class="font-bold text-lg mb-5 text-orange-300">Nous suivre</h4>

                <div class="flex gap-4 mb-6">
                    <a href="#" class="w-10 h-10 rounded-full bg-orange-500/10 border border-orange-500/30 flex items-center justify-center hover:bg-orange-500 hover:text-black transition">
                        <i data-feather="instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-orange-500/10 border border-orange-500/30 flex items-center justify-center hover:bg-orange-500 hover:text-black transition">
                        <i data-feather="facebook"></i>
                    </a>
                    <a href="#" class="w-10 h-10 rounded-full bg-orange-500/10 border border-orange-500/30 flex items-center justify-center hover:bg-orange-500 hover:text-black transition">
                        <i data-feather="phone"></i>
                    </a>
                </div>

                <p class="text-sm text-orange-200">
                    Contactez-nous pour commandes & partenariats.
                </p>
            </div>

        </div>

        <!-- DIVIDER -->
        <div class="border-t border-orange-500/20 pt-6 flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-orange-300">

            <p>
                © {{ date('Y') }} <span class="font-semibold text-orange-400">Smoke Paradise</span>. Tous droits réservés.
            </p>

            <p class="text-xs text-orange-400">
                Design & développement — Smoke Paradise
            </p>

        </div>

    </div>

</footer>


<!-- ================= SMOKE SCRIPT ================= -->
<script>
const canvas = document.getElementById('smokeCanvas');
const ctx = canvas.getContext('2d');

function resize(){
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
resize();
window.addEventListener('resize', resize);

class Particle{
    constructor(){ this.reset(); }
    reset(){
        this.x = Math.random()*canvas.width;
        this.y = canvas.height + Math.random()*200;
        this.r = 30 + Math.random()*40;
        this.speed = 0.4 + Math.random();
        this.alpha = 0.05 + Math.random()*0.05;
    }
    update(){
        this.y -= this.speed;
        this.x += Math.sin(this.y * 0.01);
        this.alpha -= 0.0005;
        if(this.alpha <= 0) this.reset();
    }
    draw(){
        ctx.beginPath();
        ctx.arc(this.x,this.y,this.r,0,Math.PI*2);
        ctx.fillStyle = `rgba(220,220,220,${this.alpha})`;
        ctx.fill();
    }
}

const particles = Array.from({length:60},()=>new Particle());
(function animate(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    particles.forEach(p=>{p.update();p.draw();});
    requestAnimationFrame(animate);
})();
</script>

<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>


</body>
</html>
