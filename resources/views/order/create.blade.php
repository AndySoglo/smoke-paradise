<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commander - {{ $product->name }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gradient-to-br from-orange-950 via-black to-orange-900 font-sans min-h-screen text-gray-100 relative overflow-x-hidden">

<!-- Smoke Canvas décoratif -->
<canvas id="smokeCanvas" class="fixed inset-0 w-full h-full pointer-events-none z-0 opacity-40"></canvas>

<main class="relative z-10 max-w-3xl mx-auto p-6 md:p-12">

    <!-- Bouton retour -->
    <div class="mb-8">
        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-2 text-orange-400 hover:text-orange-200 font-semibold transition transform hover:translate-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Retour
        </a>
    </div>

    <!-- Titre -->
    <h1 class="text-4xl md:text-5xl font-extrabold mb-10 text-center text-orange-400 drop-shadow-[0_0_15px_rgba(249,115,22,0.7)]">
        Commander {{ $product->name }}
    </h1>

    @if(session('success'))
        <div class="bg-green-800/50 text-green-200 p-4 rounded-xl mb-8 shadow-lg border border-green-700">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulaire -->
    <form id="orderForm" class="bg-black/80 backdrop-blur-lg p-8 rounded-3xl shadow-[0_0_40px_rgba(249,115,22,0.4)] border border-orange-500/20 space-y-6">

        <!-- Arôme -->
        <div>
            <label class="block mb-2 font-semibold text-orange-300">Choisir un arôme :</label>
            <select name="flavor_id" required
                    class="w-full p-3 rounded-xl border border-orange-400/50 bg-black/50 text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
                <option value="">-- Sélectionner un arôme --</option>
                @foreach($product->flavors as $flavor)
                    <option value="{{ $flavor->id }}">{{ $flavor->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Quantité -->
        <div>
            <label class="block mb-2 font-semibold text-orange-300">Quantité :</label>
            <input type="number" name="quantity" min="1" value="1" required
                   class="w-full p-3 rounded-xl border border-orange-400/50 bg-black/50 text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
        </div>

        <!-- Nom / Prénom -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 font-semibold text-orange-300">Prénom :</label>
                <input type="text" name="first_name" required
                       class="w-full p-3 rounded-xl border border-orange-400/50 bg-black/50 text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
            </div>
            <div>
                <label class="block mb-2 font-semibold text-orange-300">Nom :</label>
                <input type="text" name="last_name" required
                       class="w-full p-3 rounded-xl border border-orange-400/50 bg-black/50 text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
            </div>
        </div>

        <!-- Téléphone -->
        <div>
            <label class="block mb-2 font-semibold text-orange-300">Téléphone :</label>
            <input type="tel" name="phone" required placeholder="Ex: 229XXXXXXXX"
                   class="w-full p-3 rounded-xl border border-orange-400/50 bg-black/50 text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition">
        </div>

        <!-- Adresse -->
        <div>
            <label class="block mb-2 font-semibold text-orange-300">Adresse :</label>
            <textarea name="address" rows="3" required
                      class="w-full p-3 rounded-xl border border-orange-400/50 bg-black/50 text-white focus:ring-2 focus:ring-orange-500 focus:border-orange-500 outline-none transition resize-y"></textarea>
        </div>

        <!-- Bouton WhatsApp -->
        <button type="button" onclick="sendToWhatsApp()"
                class="w-full bg-green-600 hover:bg-green-700 text-black font-extrabold p-4 rounded-2xl shadow-[0_0_35px_rgba(16,185,129,0.5)] flex items-center justify-center gap-3 text-lg transition transform hover:scale-[1.03]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.29.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004c-1.423-.006-2.816-.394-4.03-1.135l-.29-.172-3.007 1.022.995-3.03-.196-.292c-.804-1.198-1.23-2.59-1.23-4.026 0-4.17 3.394-7.564 7.564-7.564 2.022 0 3.92.788 5.347 2.215 1.427 1.427 2.215 3.325 2.215 5.347 0 4.17-3.394 7.564-7.564 7.564z"/>
            </svg>
            Envoyer sur WhatsApp
        </button>
    </form>
</main>

<!-- ================= SMOKE CANVAS ================= -->
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
        this.r = 30 + Math.random()*50;
        this.speed = 0.4 + Math.random();
        this.alpha = 0.05 + Math.random()*0.07;
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

const particles = Array.from({length:70},()=>new Particle());

function animate(){
    ctx.clearRect(0,0,canvas.width,canvas.height);
    particles.forEach(p=>{p.update();p.draw();});
    requestAnimationFrame(animate);
}
animate();
</script>

<script>
function sendToWhatsApp() {
    const form = document.getElementById('orderForm');
    if(!form.checkValidity()){ form.reportValidity(); return; }

    const formData = new FormData(form);
    const firstName  = formData.get('first_name') || '';
    const lastName   = formData.get('last_name') || '';
    const phone      = formData.get('phone') || '';
    const address    = formData.get('address') || '';
    const quantity   = formData.get('quantity') || '1';

    const flavorSelect = form.querySelector('select[name="flavor_id"]');
    const flavorName = flavorSelect.options[flavorSelect.selectedIndex]?.text || 'Non spécifié';
    const productName = "{{ addslashes($product->name) }}";

    let message = `*Nouvelle commande !*\n\nProduit : *${productName}*\nArôme : *${flavorName}*\nQuantité : *${quantity}*\n\nClient : ${firstName} ${lastName}\nTél : ${phone}\nAdresse : ${address.replace(/\n/g,' ')}\n\nMerci de confirmer la commande 😊`;

    const whatsappUrl = `https://wa.me/22953978474?text=${encodeURIComponent(message)}`;
    window.open(whatsappUrl, '_blank');
}
</script>

</body>
</html>
