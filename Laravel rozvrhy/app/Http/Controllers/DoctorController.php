<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\Carer;
use Illuminate\View\View;
use Illuminate\Contracts\Database\Eloquent\Builder;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        

        $doctors_all = Doctor::with('carer')->get();
        Doctor::replace($doctors_all);

        foreach ($doctors_all as $doctor) {

            $doctor['name'] = $doctor->carer->last_name;
            
        }
        
        $sorted = $doctors_all->sortBy('order')->sortBy('name');

        return view('doctors.doctors', 
        [   'doctors' => $sorted,
            
        ]);
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
            'day' => 'required|string|max:255',
            'from' => 'required|date_format:H:i',
            'to' => 'required|date_format:H:i|after:from',
            'carer_id' => 'required|integer',
        ]);

        $carer_id = $validated['carer_id'];

        $carer = Carer::find($carer_id);

        $carer->doctors()->create($validated);

        return redirect(route('carers.edit', $carer));

    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor, Request $request) : RedirectResponse
    {
        
        $carer_id = $doctor['carer_id'];
        $info = $request->input('info');
        $doctor->delete();

        if ($info  == 'info') 
            {
                $doctors_all = Doctor::with('carer')->get();
                Doctor::replace($doctors_all);
        
                foreach ($doctors_all as $doctor) {
        
                    $doctor['name'] = $doctor->carer->last_name;
                    
                }
                return redirect(route('doctors.index'));
        
            } 
        
       return redirect(route('carers.edit', $carer_id));
    }
}
