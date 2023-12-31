<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\CreateWarehouseRequest;
use App\Http\Requests\Warehouse\UpdateWarehouseRequest;
use App\Models\Supplier;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::with('suppliers')->paginate(10);
        return view('warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        $suppliers = Supplier::select('id', 'name')->get();

        return view('warehouses.create', compact('suppliers'));
    }

    public function store(CreateWarehouseRequest $request)
    {
        $validatedData = $request->validated();

        $warehouse = Warehouse::create($validatedData);

        $warehouse->suppliers()->sync($request->input('suppliers', []));

        return redirect()->route('warehouses.index')->with('success', 'Sklad byl úspěšně vytvořen.');
    }

    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $suppliers = Supplier::select('id', 'name')->get();

        return view('warehouses.edit', compact('warehouse', 'suppliers'));
    }

    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {
        $validatedData = $request->validated();

        $warehouse->update($validatedData);

        $warehouse->suppliers()->sync($request->input('suppliers', []));

        return redirect()->route('warehouses.index')->with('success', 'Sklad byl úspěšně upraven.');
    }

    public function destroy(Warehouse $warehouse)
    {
        try {
            if($warehouse->products()->exists()) {
                return redirect()->back()->with('error', 'Sklad není možné odstranit. Ve skladu jsou evidovány produkty');
            }

            $warehouse->delete();
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Při procesu odstranění skladu došlo k chybě');
        }

        return redirect()->route('warehouses.index')->with('success', 'Sklad byl úspěšně smazán.');
    }
}
