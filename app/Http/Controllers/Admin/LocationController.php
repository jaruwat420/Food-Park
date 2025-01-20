<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\LocationsDataTable;
use App\Models\Locations;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index (LocationsDataTable $dataTable)
    {
        return $dataTable->render ('admin.location.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "Coming Soon";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Locations::create([
            'name' => $request->name,
            'description' => $request->email,
        ]);
        toastr()->success('Create Location Successfully.');

        return to_route('admin.location.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $locations = Locations::findOrFail($id);
        return view ('admin.location.edit', compact('locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $location = Locations::findOrFail($id);
        $location->name = $request->name;
        $location->description = $request->description;
        $location->save();

        toastr('Update Location Successfully.', 'success');
        return to_route('admin.location.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $location = Locations::findOrFail($id);
            $location->delete();

            return response(['status' => 'success', 'message' => 'Delete Location Successfully.']);
        } catch (\exception $e) {
            return response(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
