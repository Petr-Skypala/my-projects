<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Carer;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'house_number' => 'required|string|max:255',
            'approx_number' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'form_name' => 'nullable|string|max:255',
        ]);
        
        $form = $request->form_name;

        if ($form == 'client')
            {
            $client = Client::find($request->client_id);

            $client->address()->create($validated);

            return redirect(route('clients.edit', $client));
        }
        elseif ($form == 'carer') {
            $carer = Carer::find($request->carer_id);
    
            $carer->address()->create($validated);
    
            return redirect(route('carers.edit', $carer));
        }

        else return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
}
