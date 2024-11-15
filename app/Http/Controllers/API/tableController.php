<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class tableController extends Controller
{
   public function index()
   {
       $tables = Table::all();
       $data = [
                'tables' => $tables,
                'status' => 200
       ];
       
       return response()->json($data, 200);
   }

   public function show($id)
   {
       $table = Table::find($id);
       
       if (!$table) {
           return response()->json([
               'message' => 'Table not found',
               'status' => 404
           ], 404);
       };

       $data = [
                'tables' => $table,
                'status' => 200
       ];
       return response()->json($data, 200);
   }

   public function store(Request $request)
   {
        $validator = Validator::make($request->all(), [
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:50',
            'capacity' => 'nullable|integer|min:1',
            'status' => 'nullable|string|max:25',
            'zone' => 'nullable|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }

        $table = Table::create([
            'unit_id' => $request->unit_id,
            'name' => $request->name,
            'capacity' => $request->capacity ?? 1,
            'status' => $request->status ?? 'active',
            'zone' => $request->zone ?? 'main'
        ]);

       if (!$table) {
           return response()->json([
               'message' => 'Error creating table',
               'status' => 500
           ], 500);
       }

       return response()->json([
           'table' => $table,
           'status' => 201
       ], 201);
   }

   public function update(Request $request, $id)
   {
       $table = Table::find($id);

       if (!$table) {
           return response()->json([
               'message' => 'Table not found',
               'status' => 404
           ], 404);
       }

       $validator = Validator::make($request->all(), [
           'unit_id' => 'exists:units,id',
           'name' => 'string|max:50',
           'capacity' => 'integer|min:2',
           'status' => 'string|max:25',
           'zone' => 'string|max:50'
       ]);

       if ($validator->fails()) {
           return response()->json([
               'message' => 'Validation error',
               'errors' => $validator->errors(),
               'status' => 400
           ], 400);
       }

       $table->update([
           'unit_id' => $request->unit_id ?? $table->unit_id,
           'name' => $request->name ?? $table->name,
           'capacity' => $request->capacity ?? $table->capacity,
           'status' => $request->status ?? $table->status,
           'zone' => $request->zone ?? $table->zone
       ]);

       $data = [
                'table' => $table,
                'status' => 200
       ];
       return response()->json($data, 200);
   }

   public function destroy($id)
   {
       $table = Table::find($id);

       if (!$table) {
           return response()->json([
               'message' => 'Table not found',
               'status' => 404
           ], 404);
       }

       $table->delete();

       return response()->json([
           'message' => 'Table deleted successfully',
           'status' => 200
       ], 200);
   }
}