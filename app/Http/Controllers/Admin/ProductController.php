<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Flavor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $flavors = Flavor::all();
        return view('admin.products.create', compact('flavors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'image' => 'nullable|image',
            'flavors' => 'required|array'
        ]);

        $data = $request->only(['name','description','price','status']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products','public');
        }

        $product = Product::create($data);
        $product->flavors()->sync($request->flavors);

        return redirect()->route('admin.products.index')
            ->with('success','Produit ajouté');
    }

    public function edit(Product $product)
    {
        $flavors = Flavor::all();
        return view('admin.products.edit', compact('product','flavors'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'flavors' => 'required|array'
        ]);

        $data = $request->only(['name','description','price','status']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products','public');
        }

        $product->update($data);
        $product->flavors()->sync($request->flavors);

        return redirect()->route('admin.products.index')
            ->with('success','Produit modifié');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success','Produit supprimé');
    }
}
