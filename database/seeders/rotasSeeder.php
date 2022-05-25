<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
         'week_commence_date'=>Carbon::create(2022,5,16,0,0,0)->toDateTimeString()
        ]);
    }
}
