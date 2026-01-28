<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; // ✅ Bien importé
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Flavor;


class FrontController extends Controller
{
    public function home()
    {
        // On récupère tous les produits actifs avec leurs arômes
        $products = Product::with('flavors')->where('status', 1)->get();

        return view('home', compact('products'));
    }

     public function create(Product $product)
    {
        // Charger les arômes du produit
        $product->load('flavors');

        return view('order.create', compact('product'));
    }

    public function products()
{
    // Tous les produits actifs + leurs arômes
    $products = Product::with('flavors')
        ->where('status', 1)
        ->latest()           // les plus récents en premier
        ->get();

    return view('products', compact('products'));
}

 }

