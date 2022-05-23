<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('rotas')->insert([
         'shop_id'=>1,
         'week_commence_date'=>date('2022-05-16')
        ]);
    }
}
