<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
   public function index()
   {
       $users = User::all();
       $data = [
              'users' => $users,
              'status' => 200
       ];

       return response()->json($data, 200);
   }

   public function show($id)
   {
       $user = User::find($id);
       
       if (!$user) {
           return response()->json([
               'message' => 'User not found',
               'status' => 404
           ], 404);
       };

       $data = [
              'users' => $user,
              'status' => 200
       ];
       return response()->json($data, 200);
   }

   public function store(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:8',
           'name' => 'nullable|string|max:50',
           'phone' => 'nullable|string|max:10',
           'role' => 'nullable|string|max:25',
           'status' => 'nullable|string|max:25'
       ]);

       if ($validator->fails()) {
           return response()->json([
               'message' => 'Validation error',
               'errors' => $validator->errors(),
               'status' => 400
           ], 400);
       }

       $user = User::create([
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'name' => $request->name ?? null,
           'phone' => $request->phone ?? null,
           'role' => $request->role ?? 'user',
           'status' => $request->status ?? 'active'
       ]);

       if (!$user) {
           return response()->json([
               'message' => 'Error creating user',
               'status' => 500
           ], 500);
       }

       return response()->json([
           'user' => $user,
           'status' => 201
       ], 201);
   }

   public function update(Request $request, $id)
   {
       $user = User::find($id);

       if (!$user) {
           return response()->json([
               'message' => 'User not found',
               'status' => 404
           ], 404);
       }

       $validator = Validator::make($request->all(), [
           'email' => 'string|email|max:255|unique:users,email,'.$id,
           'password' => 'nullable|string|min:8',
           'name' => 'nullable|string|max:50',
           'phone' => 'nullable|string|max:10',
           'role' => 'nullable|string|max:25',
           'status' => 'nullable|string|max:25'
       ]);

       if ($validator->fails()) {
           return response()->json([
               'message' => 'Validation error',
               'errors' => $validator->errors(),
               'status' => 400
           ], 400);
       }

       $updateData = [
           'email' => $request->email ?? $user->email,
           'name' => $request->name ?? $user->name,
           'phone' => $request->phone ?? $user->phone,
           'role' => $request->role ?? $user->role,
           'status' => $request->status ?? $user->status
       ];

       if ($request->has('password')) {
           $updateData['password'] = Hash::make($request->password);
       }

       $user->update($updateData);
       $data = [
              'user' => $user,
              'status' => 200
       ];
        return response()->json($data, 200);
   }

   public function destroy($id)
   {
       $user = User::find($id);

       if (!$user) {
           return response()->json([
               'message' => 'User not found',
               'status' => 404
           ], 404);
       }

       $user->delete();

       return response()->json([
           'message' => 'User deleted successfully',
           'status' => 200
       ], 200);
   }
}