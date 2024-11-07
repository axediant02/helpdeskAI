<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function addAdmin(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $admin = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'admin',
        ]);

        return response()->json($admin, 201);
    }

    public function listAdmins(){
        $admins = User::all();
        return response()->json($admins, 200);
    }

    public function editAdmin(Request $request, $id){
        $admin = User::find($id);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $admin->id,
            'password' => 'sometimes|min:8',
            'role' => 'required|in:admin,user',
        ]);

        $admin->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'] ? Hash::make($validatedData['password']) : $admin->password,
            'role' => $validatedData['role'],
        ]);

        return response()->json($admin, 200);
    }

    public function deleteAdmin($id){
        $admin = User::find($id);
        $admin->delete();
        return response()->json(['message' => 'Admin deleted successfully'], 200);
    }
}
