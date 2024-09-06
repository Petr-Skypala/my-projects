<?php

namespace App\Http\Controllers;

use App\Models\Carer;
use App\Models\Address;
use App\Models\Daytime;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CarerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('carers.carer_overview', ['carers' => Carer::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('carers.new_carer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'weekly_hours' => 'required|integer|min:0|max:40',

        ]);
 
        $carer=Carer::create($validated);
 
        return redirect(route('carers.edit', $carer));
    }

    /**
     * Display the specified resource.
     */
    public function show(Carer $carer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carer $carer) : View
    {
        Gate::authorize('edit', $carer);

        $address = Address::where('carer_id', $carer->id)->first();

        $monday = Carer::find($carer['id'])->daytimes->where('day', 'Mon')->first();
        $tuesday = Carer::find($carer['id'])->daytimes->where('day', 'Tue')->first();
        $wednesday = Carer::find($carer['id'])->daytimes->where('day', 'Wed')->first();
        $thursday = Carer::find($carer['id'])->daytimes->where('day', 'Thu')->first();
        $friday = Carer::find($carer['id'])->daytimes->where('day', 'Fri')->first();
        $days_hours = [$monday, $tuesday, $wednesday, $thursday, $friday];
        $doctors_res = Carer::find($carer['id'])->doctors;
        
        Doctor::replace($doctors_res);
        $sorted = $doctors_res->sortBy('order');

        return view('carers.edit', 
            ['carer' => $carer,
             'address' => $address,
             'days' => ['Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek',],
             'day_en' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri',],
             'monday' => $monday,
             'days_hours' => $days_hours,
             'doctors' => $sorted,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carer $carer) : RedirectResponse
    {
        Gate::authorize('update', $carer);
 
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'weekly_hours' => 'required|integer|min:0|max:40',
        ]);
 
        $carer->update($validated);
 
        return redirect(route('carers.edit', $carer));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carer $carer)
    {
        //
    }
}
