<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(UserRegistrationRequest $request)
    {
        $hashedPassword = bcrypt($request->password);
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $hashedPassword,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'id_card' => $request->id_card,
            'umkm_id' => $request->umkm_id,
            'umkm_name' => $request->umkm_name,
            'umkm_address' => $request->umkm_address,
            'umkm_city' => $request->umkm_city,
            'umkm_country' => $request->umkm_country,
        ]);

        return redirect()->route('index')->with('success', 'User berhasil dibuat.');
    }



    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('user.show', compact('user'));
    }
    
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->update($request->all());

        return redirect()->back()->with('success', 'User berhasil diperbarui.');
    }
}
