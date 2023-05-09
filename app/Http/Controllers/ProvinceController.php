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

    public function indexDistrict($id)
    {
        $districts = District::where('city_id', $id)->get();

        if($districts->isEmpty()) {
            return response()->json(['message' => 'İlçe bulunamadı.'], 404);
        }
        return response()->json(['districts' => $districts], 200);
    }
   
}
