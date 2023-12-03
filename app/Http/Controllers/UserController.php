<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'bio' => 'string|max:255',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'current_password' => ['required_with:password', function ($attribute, $value, $fail) use ($user) {
                if ($value && !Hash::check($value, $user->password)) {
                    $fail('Current password is incorrect.');
                }
            }],
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $path;
        }

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        if (isset($validatedData['bio'])) {
            $validatedData['bio'] = $request->input('bio');
        }

        $user->update($validatedData);

        return response()->json($user);
    }
}
