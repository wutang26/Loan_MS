<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class HighChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
         
             //Egar load a relation ship controller for member and districts and region
        // $members = Member::with(['region', 'district'])->get();
    

        // return view('statics.estimated_joined', compact('members'));

         $members = Member::with(['region', 'district'])->get();

        $categories = ['Temeke', 'Mufindi', 'Mvomero', 'Lindi', 'Nyegezi', 'Nzega'];

        $regionData = [387749, 280000, 129000, 64300, 54000, 34300];
        $districtData = [45321, 140000, 10000, 140500, 19500, 113500];

        return view('statics.estimated_joined', compact(
            'categories',
            'regionData',
            'districtData'
        ));
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
    public function destroy(string $id)
    {
        //
    }
}
