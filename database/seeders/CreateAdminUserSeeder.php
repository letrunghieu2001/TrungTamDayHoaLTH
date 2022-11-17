<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'firstname' => 'Lê',
            'lastname' => 'Trung Hiếu',
            'email' => 'letrunghieu2001@gmail.com',
            'password' => '12345678',
            'role_id' => config('constants.role.admin'),
            'gender' => 'Nam',
            'phone' => '0942225766',
            'dob' => '2001-03-04',
            'bank' => 'VIB',
            'credit_number' => '048704060117045',
            'avatar' => 'default-avatar.png',
            'created_at' => Carbon::now()
        ]);
    }
}
