<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flavor;
use Illuminate\Http\Request;

class FlavorController extends Controller
{
    public function index()
    {
       $flavors = Flavor::orderBy('id', 'asc')->paginate(10); // tri croissant
        return view('admin.flavors.index', compact('flavors'));
    }

    public function create()
    {
        return view('admin.flavors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:flavors,name',
        ]);

        Flavor::create($request->only('name'));

        return redirect()->route('admin.flavors.index')
            ->with('success', 'Arôme ajouté');
    }

    public function edit(Flavor $flavor)
    {
        return view('admin.flavors.edit', compact('flavor'));
    }

    public function update(Request $request, Flavor $flavor)
    {
        $request->validate([
            'name' => 'required|unique:flavors,name,'.$flavor->id,
        ]);

        $flavor->update($request->only('name'));

        return redirect()->route('admin.flavors.index')
            ->with('success', 'Arôme modifié');
    }

    public function destroy(Flavor $flavor)
    {
        $flavor->delete();

        return back()->with('success', 'Arôme supprimé');
    }
}
