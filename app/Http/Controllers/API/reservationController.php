<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class reservationController extends Controller
{
   public function index()
   {
       $reservations = Reservation::all();
       $data = [
              'reservations' => $reservations,
              'status' => 200
       ];

       return response()->json($data, 200);
   }

   public function show($id)
   {
       $reservation = Reservation::find($id);
       
       if (!$reservation) {
           return response()->json([
               'message' => 'Reservation not found',
               'status' => 404
           ], 404);
       };

       $data = [
                'reservations' => $reservation,
                'status' => 200
       ];
       return response()->json($data, 200);
   }

   public function store(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'unit_id' => 'required|exists:units,id',
           'user_id' => 'nullable|exists:users,id',
           'table_ids' => 'required|array',
           'table_ids.*' => 'exists:tables,id',
           'datetime' => 'required|date',
           'pax' => 'nullable|integer|min:1',
           'status' => 'nullable|string|max:25'
       ]);

       if ($validator->fails()) {
           return response()->json([
               'message' => 'Validation error',
               'errors' => $validator->errors(),
               'status' => 400
           ], 400);
       }

       // Validar que todas las mesas pertenecen al unit_id especificado
       $tables = Table::whereIn('id', $request->table_ids)
                     ->where('unit_id', '!=', $request->unit_id)
                     ->exists();

       if ($tables) {
           return response()->json([
               'message' => 'Some tables do not belong to the specified unit',
               'status' => 400
           ], 400);
       }

       $reservation = Reservation::create([
           'unit_id' => $request->unit_id,
           'user_id' => $request->user_id,
           'table_ids' => $request->table_ids,
           'datetime' => $request->datetime,
           'pax' => $request->pax ?? 1,
           'status' => $request->status ?? 'pending'
       ]);

       if (!$reservation) {
           return response()->json([
               'message' => 'Error creating reservation',
               'status' => 500
           ], 500);
       }

       return response()->json([
           'reservation' => $reservation,
           'status' => 201
       ], 201);
   }

   public function update(Request $request, $id)
   {
       $reservation = Reservation::find($id);

       if (!$reservation) {
           return response()->json([
               'message' => 'Reservation not found',
               'status' => 404
           ], 404);
       }

       $validator = Validator::make($request->all(), [
           'unit_id' => 'exists:units,id',
           'user_id' => 'nullable|exists:users,id',
           'table_ids' => 'array',
           'table_ids.*' => 'exists:tables,id',
           'datetime' => 'date',
           'pax' => 'nullable|integer|min:1',
           'status' => 'nullable|string|max:25'
       ]);

       if ($validator->fails()) {
           return response()->json([
               'message' => 'Validation error',
               'errors' => $validator->errors(),
               'status' => 400
           ], 400);
       }

       // Si se están actualizando las mesas y/o la unidad, validar que coincidan
       if ($request->has('table_ids')) {
           $unit_id = $request->unit_id ?? $reservation->unit_id;
           
           $tables = Table::whereIn('id', $request->table_ids)
                         ->where('unit_id', '!=', $unit_id)
                         ->exists();

           if ($tables) {
               return response()->json([
                   'message' => 'Some tables do not belong to the specified unit',
                   'status' => 400
               ], 400);
           }
       }

       $reservation->update([
           'unit_id' => $request->unit_id ?? $reservation->unit_id,
           'user_id' => $request->user_id ?? $reservation->user_id,
           'table_ids' => $request->table_ids ?? $reservation->table_ids,
           'datetime' => $request->datetime ?? $reservation->datetime,
           'pax' => $request->pax ?? $reservation->pax,
           'status' => $request->status ?? $reservation->status
       ]);
       $data = [
               'reservation' => $reservation,
               'status' => 200
       ];
        return response()->json($data, 200);
   }

   public function destroy($id)
   {
       $reservation = Reservation::find($id);

       if (!$reservation) {
           return response()->json([
               'message' => 'Reservation not found',
               'status' => 404
           ], 404);
       }

       $reservation->delete();

       return response()->json([
           'message' => 'Reservation deleted successfully',
           'status' => 200
       ], 200);
   }
}