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
            'password' => bcrypt('admin')
        ]);

        $data = [
            ['id' => 1, "code" => 'SNC1', 'name' => 'Sconnect', 'id_department_parent' => 1],

            ['id' => 2, "code" => 'SNC2', 'name' => 'Phòng Công Nghệ', 'id_department_parent' => 1],
            ['id' => 8, "code" => 'SNC3', 'name' => 'Nhóm Phát Triển Phần Mềm', 'id_department_parent' => 2],
            ['id' => 9, "code" => 'SNC4', 'name' => 'Nhóm Quản Trị Hệ Thống', 'id_department_parent' => 2],

            ['id' => 3, "code" => 'SNC3', 'name' => 'Phòng Hành Chính Nhân Sự', 'id_department_parent' => 1],
            ['id' => 10, "code" => 'SNC4', 'name' => 'Phòng Hành Chính Nhân Sự Con', 'id_department_parent' => 3],

            ['id' => 4, "code" => 'SNC4', 'name' => 'Phòng Pháp Chế', 'id_department_parent' => 1],
            ['id' => 11, "code" => 'SNC4', 'name' => 'Phòng Pháp Chế 1', 'id_department_parent' => 4],
            ['id' => 12, "code" => 'SNC4', 'name' => 'Phòng Pháp Chế 2', 'id_department_parent' => 4],
            ['id' => 13, "code" => 'SNC4', 'name' => 'Phòng Pháp Chế 3', 'id_department_parent' => 4],
            ['id' => 14, "code" => 'SNC4', 'name' => 'Phòng Pháp Chế 4', 'id_department_parent' => 4],

            ['id' => 5, "code" => 'SNC5', 'name' => 'Ban Giám Đốc', 'id_department_parent' => 1],
            ['id' => 6, "code" => 'SNC6', 'name' => 'Ban Dự Án', 'id_department_parent' => 1],
            ['id' => 7, "code" => 'SNC7', 'name' => 'Ban Tài Chính', 'id_department_parent' => 1],
        ];

        DB::table('departments')->insert($data);
    }
}
