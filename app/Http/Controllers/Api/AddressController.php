<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\District;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function districts(Request $request)
    {
        return response()->json([
            'districts' => District::when($request->has('division_id'), function ($q) use ($request) {
                $q->where('division_id', $request->input('division_id'));
            })->get()
        ], 200);
    }

    public function areas(Request $request)
    {
        return response()->json([
            'areas' => Area::when($request->has('district_id'), function ($q) use ($request) {
                $q->where('district_id', $request->input('district_id'));
            })->get()
        ], 200);
    }
}
