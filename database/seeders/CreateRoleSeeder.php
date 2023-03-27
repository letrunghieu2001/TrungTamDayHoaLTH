<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id' => config('constants.role.admin'), 'name' => 'Quản trị viên', 'created_at' => Carbon::now()],
            ['id' => config('constants.role.teacher'), 'name' => 'Giáo viên', 'created_at' => Carbon::now()],
            ['id' => config('constants.role.student'), 'name' => 'Học sinh', 'created_at' => Carbon::now()],
        ]);
    }
}
