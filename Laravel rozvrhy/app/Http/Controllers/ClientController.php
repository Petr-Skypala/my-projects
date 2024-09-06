<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('clients.client_overview', ['clients' => Client::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('clients.new_client');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',

        ]);
 
        $client=Client::create($validated);
 
        return redirect(route('clients.edit', $client));

    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client) : View
    {
        Gate::authorize('update', $client);

        $address = Address::where('client_id', $client->id)->first();

        return view('clients.client_edit', 
        ['client' => $client,
         'address' => $address,

        ]
    );

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client) : RedirectResponse
    {
        Gate::authorize('update', $client);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',

        ]);

        $client->update($validated);

        return redirect(route('clients.edit', $client));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
