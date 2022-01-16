<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * 機能(実装例)
 */
class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('works')->insert([
            [
                'title'    => 'テスト',
                'image'    => '',
                'introduction'  => 'aaaaaaaaaaaaaaaaaaaaaaaaa',
                'hr_company_id' => 1,
            ],
        ]);
    }
}
