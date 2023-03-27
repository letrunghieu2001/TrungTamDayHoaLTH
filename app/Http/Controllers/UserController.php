<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordUserRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function indexAdmin(Request $request)
    {
        $query = User::query()->where('role_id', '1');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('email', 'LIKE', "%" . $q . "%")
                    ->orWhere('unique_id', 'LIKE', "%" . $q . "%")
                    ->orWhere(DB::raw("CONCAT(`firstname`, ' ', `lastname`)"), 'LIKE', "%" . $q . "%");
            });
        }

        $users = $query->latest()->paginate(9);

        return view('pages.user-management.user-management-admin', compact('users'));
    }

    public function indexTeacher(Request $request)
    {
        $query = User::query()->where('role_id', '2');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('email', 'LIKE', "%" . $q . "%")
                    ->orWhere('unique_id', 'LIKE', "%" . $q . "%")
                    ->orWhere(DB::raw("CONCAT(`firstname`, ' ', `lastname`)"), 'LIKE', "%" . $q . "%");
            });
        }

        $users = $query->latest()->paginate(9);

        return view('pages.user-management.user-management-teacher', compact('users'));
    }

    public function indexStudent(Request $request)
    {
        $query = User::query()->where('role_id', '3');

        if ($request->has('q')) {
            $q = trim($request->input('q'));
            $query->where(function ($query) use ($q) {
                $query->where('email', 'LIKE', "%" . $q . "%")
                    ->orWhere('unique_id', 'LIKE', "%" . $q . "%")
                    ->orWhere(DB::raw("CONCAT(`firstname`, ' ', `lastname`)"), 'LIKE', "%" . $q . "%");
            });
        }

        $users = $query->latest()->paginate(9);

        return view('pages.user-management.user-management-student', compact('users'));
    }

    public function create()
    {
        return view('pages.user-management.create');
    }
    public function store(CreateUserRequest $request)
    {
        $input = $request->except('password_confirmation');
        $input['password'] = $request->password;
        $input['avatar'] = $request->avatar;
        $avatar = $request->avatar;

        if ($input['avatar'] == null) {
            $input['avatar'] = 'default-avatar.png';
        } else {
            $avatarName = time() . '.' . $avatar->extension();
            $avatar->storeAs('public/avatar', $avatarName);

            $input['avatar'] = $avatarName;
        }
        if ($input['role_id'] == 1) {
            $input['unique_id'] = IdGenerator::generate(['table' => 'users', 'field' => 'unique_id', 'length' => 8, 'prefix' =>  'AD' . date('y'), 'reset_on_prefix_change' => true]);
        }
        if ($input['role_id'] == 2) {
            $input['unique_id'] = IdGenerator::generate(['table' => 'users', 'field' => 'unique_id', 'length' => 8, 'prefix' =>  'GV' . date('y'), 'reset_on_prefix_change' => true]);
        }
        if ($input['role_id'] == 3) {
            $input['unique_id'] = IdGenerator::generate(['table' => 'users', 'field' => 'unique_id', 'length' => 8, 'prefix' =>  'HS' . date('y'), 'reset_on_prefix_change' => true]);
        }

        $user = User::create($input);

        

        return back()->with('succes', 'Tạo mới người dùng thành công');
    }

    public function edit(User $user)
    {
        return view('pages.user-management.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $id = $user->id;
        $avatar = $request->avatar;
        $oldAvatar = $user->avatar;
        if ($avatar != null) {
            if ($oldAvatar != "default-avatar.png") {
                Storage::disk('public')->delete("avatar/" . $oldAvatar);
            }
            $avatarName = time() . '.' . $avatar->extension();
            $avatar->storeAs('public/avatar', $avatarName);

            User::findOrFail($id)->update([
                'avatar' => $avatarName
            ]);
        }
        User::findOrFail($id)->update([
            'firstname' => $request->get('firstname'),
            'role_id' => $request->get('role_id'),
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

    public function updatePassword(ChangePasswordUserRequest $request, User $user)
    {
        $id = $user->id;
        User::findOrFail($id)
            ->update([
                'password' => $request->get('new_password')
            ]);
        $error = null;

        if ($error == null) {
            return back()
                ->with('succes', 'Mật khẩu đã được thay đổi thành công');
        } else {
            return back()->with('error', $error);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('succes', 'Người dùng trên đã bị vô hiệu hóa');
    }

    public function deleteAccount()
    {
        $users = User::onlyTrashed()->latest()->paginate(9);
        return view('pages.user-management.delete-account', compact('users'));
    }

    public function restore($user)
    {
        User::onlyTrashed()->where('id', $user)->restore();
        return back()->with('succes', 'Người dùng trên đã được khôi phục');
    }

    public function restoreAll()
    {
        User::onlyTrashed()->restore();
        return back()->with('succes', 'Toàn bộ người dùng đã được khôi phục');
    }

    public function forceDelete($user)
    {
        $get_user = User::onlyTrashed()->where('id', $user)->first();
        if (optional($get_user)->avatar != "default-avatar.png") {
            Storage::disk('public')->delete("avatar/" . $get_user->avatar);
        }
        User::onlyTrashed()->where('id', $user)->forceDelete();
        return back()->with('succes', 'Người dùng trên đã bị xóa hoàn toàn khỏi hệ thống');
    }
}
