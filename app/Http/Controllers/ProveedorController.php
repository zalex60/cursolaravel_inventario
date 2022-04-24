<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the proveedor.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $proveedorQuery = Proveedor::query();
        $proveedorQuery->where('name', 'like', '%'.request('q').'%');
        $proveedors = $proveedorQuery->paginate(25);

        return view('proveedors.index', compact('proveedors'));
    }

    /**
     * Show the form for creating a new proveedor.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Proveedor);

        return view('proveedors.create');
    }

    /**
     * Store a newly created proveedor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Proveedor);

        $newProveedor = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newProveedor['creator_id'] = auth()->id();

        $proveedor = Proveedor::create($newProveedor);

        return redirect()->route('proveedors.show', $proveedor);
    }

    /**
     * Display the specified proveedor.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\View\View
     */
    public function show(Proveedor $proveedor)
    {
        return view('proveedors.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified proveedor.
     *
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\View\View
     */
    public function edit(Proveedor $proveedor)
    {
        $this->authorize('update', $proveedor);

        return view('proveedors.edit', compact('proveedor'));
    }

    /**
     * Update the specified proveedor in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $this->authorize('update', $proveedor);

        $proveedorData = $request->validate([
            'name'        => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $proveedor->update($proveedorData);

        return redirect()->route('proveedors.show', $proveedor);
    }

    /**
     * Remove the specified proveedor from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proveedor  $proveedor
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Proveedor $proveedor)
    {
        $this->authorize('delete', $proveedor);

        $request->validate(['proveedor_id' => 'required']);

        if ($request->get('proveedor_id') == $proveedor->id && $proveedor->delete()) {
            return redirect()->route('proveedors.index');
        }

        return back();
    }
}
