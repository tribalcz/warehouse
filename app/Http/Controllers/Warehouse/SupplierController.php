<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\CreateSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(CreateSupplierRequest $request)
    {
        $validatedData = $request->validated();

        $supplier = Supplier::create($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Dodavatel byl úspěšně vytvořen.');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $validatedData = $request->validated();

        $supplier->update($validatedData);

        return redirect()->route('suppliers.index')->with('success', 'Dodavatel byl úspěšně upraven.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Dodavatel byl úspěšně smazán.');
    }
}
