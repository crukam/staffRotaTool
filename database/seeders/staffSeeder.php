<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class staffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staffsList = [
            ['first_name'=>'Black','surname'=>'Widow','shop_id'=>1],
            ['first_name'=>'Thor','surname'=>'','shop_id'=>1],
            ['first_name'=>'Wolverine','surname'=>'','shop_id'=>1],
            ['first_name'=>'Gamora','surname'=>'','shop_id'=>1]
        ];

        foreach($staffsList as $staff)
        {
            DB::table('staff')->insert([
                'first_name'=>$staff['first_name'],
                'surname'=>$staff['surname'],
                'shop_id'=>$staff['shop_id']
            ]);
        }
        
    }
}
