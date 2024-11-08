<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\DataTables\ContactDataTable;

class AdminContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ContactDataTable $dataTable)
    {
        return $dataTable->render ('admin.contact.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();
            return response(['status' => 'success', 'message' => 'Delete Contact Successfully.']);
        } catch (\exception $e) {
            return response(['status' => 'error', 'message' => 'something wen wrong.']);
        }
    }

}

