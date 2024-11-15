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
       $data = [
              'units' => $units,
              'status' => 200
       ];
     

      return response()->json($data, 200);
   }

   public function show($id)
   {
       $unit = Unit::find($id);
       
       if (!$unit) {
           return response()->json([
               'message' => 'Unit not found',
               'status' => 404
           ], 404);
       }
       $data = [
              'units' => $unit,
              'status' => 200
       ];

       return response()->json($data, 200);
   }

   public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'business_name' => 'required|string|max:50',
            'tax_id' => 'required|string|max:15',
            'name' => 'nullable|string|max:50',
            'adress' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:10',
            'photo_path' => 'nullable|string',
            'status' => 'nullable|string|max:25',
            'zones' => 'nullable|array'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $unit = Unit::create([
            'business_name' => $request->business_name,
            'tax_id' => $request->tax_id,
            'name' => $request->name ?? null,
            'adress' => $request->adress ?? null,
            'phone' => $request->phone ?? null,
            'photo_path' => $request->photo_path,
            'status' => $request->status ?? 'active',
            'zones' => $request->zones ?? ['main']
        ]);

        if (!$unit) {
            return response()->json([
                'message' => 'Error creating unit',
                'status' => 500
            ], 400);
        }

        return response()->json([
            'unit' => $unit,
            'status' => 201
        ], 201);
    }

   public function update(Request $request, $id)
   {
       $unit = Unit::find($id);

       if (!$unit) {
           return response()->json([
               'message' => 'Unit not found',
               'status' => 404
           ], 404);
       }

       $validator = Validator::make($request->all(), [
           'name' => 'string|max:50',
           'business_name' => 'string|max:50',
           'tax_id' => 'string|max:15',
           'adress' => 'string|max:255',
           'phone' => 'string|max:10',
           'photo_path' => 'nullable|string',
           'status' => 'string|max:25',
           'zones' => 'nullable|array'
       ]);

       if ($validator->fails()) {
           return response()->json([
               'message' => 'Validation error',
               'errors' => $validator->errors(),
               'status' => 400
           ], 400);
       }

       $unit->update([
           'name' => $request->name ?? $unit->name,
           'business_name' => $request->business_name ?? $unit->business_name,
           'tax_id' => $request->tax_id ?? $unit->tax_id,
           'adress' => $request->adress ?? $unit->adress,
           'phone' => $request->phone ?? $unit->phone,
           'photo_path' => $request->photo_path ?? $unit->photo_path,
           'status' => $request->status ?? $unit->status,
           'zones' => $request->zones ?? $unit->zones
       ]);

       return response()->json([
           'unit' => $unit,
           'status' => 200
       ], 200);
   }

   public function destroy($id)
   {
       $unit = Unit::find($id);

       if (!$unit) {
           return response()->json([
               'message' => 'Unit not found',
               'status' => 404
           ], 404);
       }

       $unit->delete();

       return response()->json([
           'message' => 'Unit deleted successfully',
           'status' => 200
       ], 200);
   }
}