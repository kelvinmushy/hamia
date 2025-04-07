<?php

namespace App\Http\Controllers\Companies\ManageUnit;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Property; // if you associate units with a property
use Illuminate\Support\Facades\Auth;
use App\Models\Customer; 
use App\Http\Controllers\Controller;
class UnitController extends Controller
{
    public function index()
    {
        $properties=Property::get();
        $clients=Customer::get();
        $units = Unit::with('property')->where('creator_id', Auth::id())->get();
        return view('company.projects.property_unity.index', compact('units','properties','clients'));
    }

    public function create()
    {
        $properties = Property::where('creator_id', Auth::id())->get();
        return view('units.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'unit_name' => 'required|string|max:255',
            'unit_type' => 'required|string',
            'size' => 'nullable|numeric',
            'rent_price' => 'required|numeric|min:0',
        ]);

        Unit::create([
            'property_id' => $request->property_id,
            'unit_name' => $request->unit_name,
            'unit_type' => $request->unit_type,
            'size' => $request->size,
            'rent_price' => $request->rent_price,
            'creator_id' => Auth::id(),
        ]);

        return redirect()->route('units.index')->with('success', 'Unit added successfully!');
    }

    public function show($id)
    {
        $unit = Unit::with('property')->findOrFail($id);
        return view('units.show', compact('unit'));
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        $properties = Property::where('creator_id', Auth::id())->get();
        return view('units.edit', compact('unit', 'properties'));
    }

    public function update(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);

        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'unit_name' => 'required|string|max:255',
            'unit_type' => 'required|string',
            'size' => 'nullable|numeric',
            'rent_price' => 'required|numeric|min:0',
        ]);

        $unit->update([
            'property_id' => $request->property_id,
            'unit_name' => $request->unit_name,
            'unit_type' => $request->unit_type,
            'size' => $request->size,
            'rent_price' => $request->rent_price,
            'updator_id' => Auth::id(),
        ]);

        return redirect()->route('units.index')->with('success', 'Unit updated successfully!');
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit deleted successfully!');
    }
}
