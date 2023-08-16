<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manufacturer\CreateManufacturerRequest;
use App\Http\Requests\Manufacturer\EditManufacturerRequest;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view('manufacturer.index', compact('manufacturers'));
    }

    public function create()
    {
        return view('manufacturer.create');
    }

    public function store(CreateManufacturerRequest $request)
    {
        $validatedData = $request->validated();
        $data = $validatedData;

        Manufacturer::create($data);

        return redirect()->route('manufacturers.index')->with('success', 'Výrobce byl úspěšně vytvořen.');
    }

    public function edit(Manufacturer $manufacturer)
    {
        return view('manufacturer.edit', compact('manufacturer'));
    }

    public function update(EditManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $validatedData = $request->validated();
        $data = $validatedData;

        $manufacturer->update($data);

        return redirect()->route('manufacturers.index')->with('success', 'Výrobce byl úspěšně upraven.');

    }

    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        return redirect()->route('manufacturers.index')->with('success', 'Výrobce byl úspěšně smazán.');

    }
}
