<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::where('is_active', true)->orderBy('city')->get();
        $cities = $offices->pluck('city')->unique()->sort()->values();

        return view('offices', compact('offices', 'cities'));
    }

    public function getOfficesByCity($city)
    {
        $offices = Office::where('city', $city)
                        ->where('is_active', true)
                        ->get();

        return response()->json($offices);
    }

    public function getOfficeDetails($id)
    {
        $office = Office::findOrFail($id);

        return response()->json($office);
    }
}
