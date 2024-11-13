<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class unitController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        
///   if ($units->isEmpty()) {
///        $data = [
///            'message' => 'No units found',
///            'status' => 200
///        ];
///        return response()->json($data, 200);
///
/// }
       return response()->json($units, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'business_name' => 'required|string|max:50',
            'tax_id' => 'required|string|max:10',
            'adress' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'photo_path' => 'nullable|string',
            'status' => 'required|string|max:25'
            
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $unit = Unit::create([
            'name' => $request->name,
            'business_name' => $request->business_name,
            'tax_id' => $request->tax_id,
            'adress' => $request->adress,
            'phone' => $request->phone,
            'photo_path' => $request->photo_path,
            'status' => $request->status
        ]);

        if (!$unit) {
            $data = [
                'message' => 'Error creating unit',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'unit' => $unit,
            'status' => 201,
        ];

        return response()->json($data, 201);
        
    }

}
