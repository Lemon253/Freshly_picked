<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //追加するパラメータの詳細
        $param = [
            'id' => 1,
            'name' => '春',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        //パラメータの挿入
        DB::table('seasons')->insert($param);

        $param = [
            'id' => 2,
            'name' => '夏',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('seasons')->insert($param);

        $param = [
            'id' => 3,
            'name' => '秋',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('seasons')->insert($param);

        $param = [
            'id' => 4,
            'name' => '冬',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('seasons')->insert($param);
    }
}
