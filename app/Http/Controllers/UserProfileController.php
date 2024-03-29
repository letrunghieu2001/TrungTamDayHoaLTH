<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordUserRequest;
use App\Http\Requests\UpdateAvatarMyProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function show()
    {
        return view('pages.my-profile');
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'firstname' => ['required','max:100'],
            'lastname' => ['required','max:100'],
            'email' => ['required', 'email', 'max:255',  Rule::unique('users')->ignore(auth()->user()->id),],
            'address' => ['max:255'],
            'city' => ['max:255'],
            'country' => ['max:255'],
            'postal' => ['max:255'],
            'about' => ['max:255'],
            'bank' => ['max:10'],
            'credit_number' => ['max:20'],
            'avatar' => [
                'image',
                'max:2048',
                'mimes:jpeg,png,jpg'
            ]
        ]);

        $avatar = $request->avatar;
        $oldAvatar = Auth::user()->avatar;
        if ($avatar != null) {
            if ($oldAvatar != "default-avatar.png") {
                Storage::disk('public')->delete("avatar/" . $oldAvatar);
            }
            $avatarName = time() . '.' . $avatar->extension();
            $avatar->storeAs('public/avatar', $avatarName);

            auth()->user()->update([
                'avatar' => $avatarName
            ]);
        }
        auth()->user()->update([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'phone' => $request->get('phone'),
            'gender' => $request->get('gender'),
            'dob' => $request->get('dob'),
            'gender' => $request->get('gender'),
            'about' => $request->get('about'),
            'bank' => $request->get('bank'),
            'credit_number' => $request->get('credit_number')
        ]);

        return back()->with('succes', 'Thông tin cá nhân đã được thay đổi');
    }

    public function updatePassword(ChangePasswordUserRequest $request)
    {
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            $error = 'Mật khẩu hiện tại không đúng';
        } elseif (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
            // Current password and new password same
            $error = 'Mật khẩu mới không được trùng mật khẩu cũ';
        } else {
            $id = Auth::user()->id;
            User::findOrFail($id)
                ->update([
                    'password' => $request->get('new_password')
                ]);
            $error = null;
        }
        if ($error == null) {
            return back()
                ->with('succes', 'Mật khẩu đã được thay đổi thành công');
        } else {
            return back()->with('error', $error);
        }
    }
}
