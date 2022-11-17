<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function indexAdmin()
    {
        return view('pages.user-management.user-management-admin');
    }
    public function indexTeacher()
    {
        return view('pages.user-management.user-management-teacher');
    }
    public function indexStudent()
    {
        return view('pages.user-management.user-management-student');
    }
    public function create()
    {
        return view('pages.user-management.create');
    }
    public function store(CreateUserRequest $request)
    {
        $input = $request->except('password_confirmation');
        $input['password'] = bcrypt($request->password);
        if ($input['avatar'] == null) {
            $input['avatar'] = 'default-avatar.png';
        }

        $user = User::create($input);
        return redirect()->route('');
    }
}
