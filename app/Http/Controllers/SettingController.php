<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\District;
use Illuminate\Http\Request;
use App\Models\Currency;

class SettingController extends Controller
{
    /**
     * Display a listing of the District and Religions.
     */
    public function regions()
    {

        $regions = Region::all();

        return view('settings.regions.region', compact('regions'));
    }

    // Store Regions
    public function storeRegion(Request $request)
    {
        //Pass and Validate first
        $request->validate([
            'name'     => 'required|string|max:255', //or "required"

        ]);

        Region::create([
            'name'     => $request->name,
        ]);

        return redirect()->route('settings.regions.region')
            ->with('success', 'Region created successfully');
    }

    //Create Regions

    public function createRegion()
    {

        $regions = Region::all();

        return view('settings.regions.create_region', compact('regions'));
    }


    //Edit and Update Region
    public function editRegion(string $id)
    {

        $region = Region::find($id);

        return view('settings.regions.edit_region', compact('region'));
    }

    public function updateRegion(Request $request, string $id)
    {

        //Validate
        $request->validate([
            'name'     => 'required|string|max:255', //or "required"

        ]);

        $region = Region::find($id);

        //Forget this data will Fail
        $region->name = $request->name;

        $region->save();

        return redirect()->route('settings.regions.region')
            ->with('success', 'Region updated successfully');
    }


    public function deleteRegion($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();

        return redirect()
            ->route('settings.regions.region')
            ->with('success', 'Region deleted successfully');
    }


    //Show Districts Index page 
    public function districts()
    {

        $districts = District::all();

        return view('settings.districts.district', compact('districts'));
    }

   // Store Regions and create
    public function storeDistrict(Request $request)
    {
        //Pass and Validate first
        $request->validate([
            'name'     => 'required|string|max:255', //or "required"

        ]);
 
        District::create([
            'name'     => $request->name,
            'region_id' =>$request->region_id,
        ]);

        return redirect()->route('settings.district')
            ->with('success', 'District created successfully');
    }

    //create District
    public function createDistrict()
    {
        
        $districts = District::all();

        $regions = Region::all();

        return view('settings.districts.create_district', compact('districts','regions'));
    }

     //Edit and Update Region
    public function editDistrict(string $id)
    {
        
        $district = District::find($id);

         $regions = Region::all();

        return view('settings.districts.edit_district', compact('district','regions'));
    }

    public function updateDistrict(Request $request, string $id)
    {

        //Validate
        $request->validate([
            'name'     => 'required|string|max:255', //or "required"

        ]);

        $district = District::find($id);

        //Forget this data will Fail
        $district->name = $request->name;

        $district->save();

        return redirect()->route('settings.district')
            ->with('success', 'District updated successfully');
    }

     /**
     * Remove the specified resource from storage /Delete
     */
   public function deleteDistrict($id)
    {
        $district = District::findOrFail($id);
        $district->delete();

        return redirect()
            ->route('settings.districts.deleteDistrict')
            ->with('success', 'District deleted successfully');
    }


    //Currency Registrations

    //Show currencies
    public function currencies()
    {

        $currencies = Currency::all();

        return view('settings.currencies.currency', compact('currencies'));
    }

    // Store Currency and create
    public function storeCurrency(Request $request)
    {
        //Pass and Validate first
        $request->validate([
            'name'     => 'required|string|max:255', //or "required"

        ]);
 
        Currency::create([
            'name'     => $request->name,
        ]);

        return redirect()->route('settings.currency')
            ->with('success', 'Currency created successfully');
    }

    //create District
    public function createCurrency()
    {
        
        $currencies = Currency::all();

        return view('settings.currencies.create_currency', compact('currencies'));
    }

     
     //Edit and Update Currency
    public function editCurrency(string $id)
    {
        
        $currency = Currency::find($id);

        return view('settings.currencies.edit_currency', compact('currency'));
    }

    public function updateCurrency(Request $request, string $id)
    {

        //Validate
        $request->validate([
            'name'     => 'required|string|max:255', //or "required"

        ]);

        $currency = Currency::find($id);

        //Forget this data will Fail
        $currency->name = $request->name;

        $currency->save();

        return redirect()->route('settings.currency')
            ->with('success', 'Currency updated successfully');
    }

     /**
     * Remove the specified resource from storage /Delete
     */
   public function deleteCurrency($id)
    {
        $currencies = Currency::findOrFail($id);
        $currencies->delete();

        return redirect()
            ->route('settings.currencies.currency')
            ->with('success', 'Currency deleted successfully');
    }


   
   
}
