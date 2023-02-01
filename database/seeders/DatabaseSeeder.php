<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'admin@argon.com',
            'password' => bcrypt('secret')
        ]);

        $data = [
            ['id' => 1, "code" => 'SNC1', 'name' => 'Sconnect', 'id_department_parent' => null],
            ['id' => 2, "code" => 'SNC2', 'name' => 'Phòng Công Nghệ', 'id_department_parent' => 1],
            ['id' => 3, "code" => 'SNC3', 'name' => 'Nhóm Phát Triển Phần Mềm', 'id_department_parent' => 2],
            ['id' => 4, "code" => 'SNC4', 'name' => 'Nhóm Quản Trị Hệ Thống', 'id_department_parent' => 2],
        ];

        DB::table('departments')->insert($data);
    }
}
