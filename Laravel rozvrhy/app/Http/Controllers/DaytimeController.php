<?php

namespace App\Http\Controllers;

use App\Models\Daytime;
use App\Models\Doctor;
use App\Models\Carer;
use Illuminate\Http\Request;
use Illuminate\Http\Response; 
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;


class DaytimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {

        $daytimes_all = Daytime::with('carer')->get();
        Doctor::replace($daytimes_all);
        $now = now();

        return view('daytimes.detail', 
        [   'daytimes' => $daytimes_all,
            'now' => $now,
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
      
        $request->validate([
            'daytimes' => 'required|array',
            'daytimes.*.day' => 'required|string|max:255',
            'daytimes.*.from' => 'required',
            'daytimes.*.to' => 'required',
            'daytimes.*.day_hours' => 'required|integer|min:0|max:24',
        ]);

        $daytimes_coll = $request->input('daytimes');

        $id = $request->input('daytimes.0.carer_id');
        DB::table('daytimes')->where('carer_id', $id)->delete();

        foreach ($daytimes_coll as $one_daytime)
        {
        
            $carer_id = $one_daytime['carer_id'];



            $carer = Carer::find($carer_id);

            $carer_route = $carer;

            $carer->daytimes()->create($one_daytime);

        }

        return redirect(route('carers.edit', $carer_route));
    }

    /**
     * Display the specified resource.
     */
    public function show(Daytime $daytime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Daytime $daytime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Daytime $daytime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Daytime $daytime)
    {
        //
    }
}
