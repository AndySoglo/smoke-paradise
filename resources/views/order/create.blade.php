<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commander - {{ $product->name }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 font-sans min-h-screen">

<main class="p-6 max-w-2xl mx-auto">

    <!-- Bouton retour -->
    <div class="mb-6">
        <a href="{{ route('home') }}"
           class="inline-flex items-center gap-2 text-orange-600 hover:text-orange-800 font-medium transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Retour
        </a>
    </div>

    <h1 class="text-3xl md:text-4xl font-bold mb-8 text-orange-600 text-center md:text-left">
        Commander {{ $product->name }}
    </h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <form id="orderForm" method="POST" class="bg-white p-6 md:p-8 rounded-2xl shadow-lg space-y-5 border border-gray-100">
        @csrf

        <div>
            <label class="block mb-2 font-semibold text-gray-700">Choisir un arôme :</label>
            <select name="flavor_id" required class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition">
                <option value="">-- Sélectionner un arôme --</option>
                @foreach($product->flavors as $flavor)
                    <option value="{{ $flavor->id }}">{{ $flavor->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 font-semibold text-gray-700">Quantité :</label>
            <input type="number" name="quantity" value="1" min="1" required
                   class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition">
        </div>

        <div>
            <label class="block mb-2 font-semibold text-gray-700">Prénom :</label>
            <input type="text" name="first_name" required
                   class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition">
        </div>

        <div>
            <label class="block mb-2 font-semibold text-gray-700">Nom :</label>
            <input type="text" name="last_name" required
                   class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition">
        </div>

        <div>
            <label class="block mb-2 font-semibold text-gray-700">Téléphone :</label>
            <input type="tel" name="phone" required
                   class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition"
                   placeholder="Ex: 229XXXXXXXX">
        </div>

        <div>
            <label class="block mb-2 font-semibold text-gray-700">Adresse :</label>
            <textarea name="address" rows="3" required
                      class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-orange-400 focus:border-orange-400 outline-none transition resize-y"></textarea>
        </div>

        <!-- Bouton WhatsApp -->
        <button type="button" onclick="sendToWhatsApp()"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold p-4 rounded-xl transition transform hover:scale-[1.02] shadow-md flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.074-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.29.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004c-1.423-.006-2.816-.394-4.03-1.135l-.29-.172-3.007 1.022.995-3.03-.196-.292c-.804-1.198-1.23-2.59-1.23-4.026 0-4.17 3.394-7.564 7.564-7.564 2.022 0 3.92.788 5.347 2.215 1.427 1.427 2.215 3.325 2.215 5.347 0 4.17-3.394 7.564-7.564 7.564z"/>
            </svg>
            Envoyer la commande sur WhatsApp
        </button>
    </form>

</main>

<script>
function sendToWhatsApp() {
    const form = document.getElementById('orderForm');

    // Validation manuelle rapide (optionnel - le navigateur gère déjà required)
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const formData = new FormData(form);

    const firstName  = formData.get('first_name')   || '';
    const lastName   = formData.get('last_name')    || '';
    const phone      = formData.get('phone')        || '';
    const address    = formData.get('address')      || '';
    const quantity   = formData.get('quantity')     || '1';

    const flavorSelect = form.querySelector('select[name="flavor_id"]');
    const flavorName = flavorSelect.options[flavorSelect.selectedIndex]?.text || 'Non spécifié';

    const productName = "{{ addslashes($product->name) }}";

    let message = `*Nouvelle commande !*\n\n`;
    message += `Produit : *${productName}*\n`;
    message += `Arôme    : *${flavorName}*\n`;
    message += `Quantité : *${quantity}*\n\n`;
    message += `Client :\n`;
    message += `• ${firstName} ${lastName}\n`;
    message += `• Tél : ${phone}\n`;
    message += `• Adresse : ${address.replace(/\n/g, ' ')}\n\n`;
    message += `Merci de confirmer la commande 😊`;

    const encodedMessage = encodeURIComponent(message);
    const whatsappNumber = "22953978474"; // ← ton numéro

    const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;
    window.open(whatsappUrl, '_blank');
}
</script>

</body>
</html>
