<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexCity()
    {
        $cities = City::all();
        return response()->json(['cities' => $cities],200);
    }

    public function indexDistrict()
    {
        $districts = District::all();
        return response()->json(['districts' => $districts],200);
    }

   
}
