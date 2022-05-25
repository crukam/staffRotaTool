<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class shiftsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weeklyShifts = [
            ['rota_id'=>1,'staff_id'=>1,'start_time'=>Carbon::create(2022,5,16,9,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,16,17,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>1,'start_time'=>Carbon::create(2022,5,17,9,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,17,12,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>2,'start_time'=>Carbon::create(2022,5,17,12,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,17,17,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>3,'start_time'=>Carbon::create(2022,5,18,9,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,18,15,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>4,'start_time'=>Carbon::create(2022,5,18,11,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,18,17,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>3,'start_time'=>Carbon::create(2022,5,19,9,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,19,17,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>4,'start_time'=>Carbon::create(2022,5,19,10,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,19,12,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>1,'start_time'=>Carbon::create(2022,5,20,9,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,20,10,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>4,'start_time'=>Carbon::create(2022,5,20,10,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,20,14,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>3,'start_time'=>Carbon::create(2022,5,20,14,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,20,17,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>1,'start_time'=>Carbon::create(2022,5,21,9,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,21,14,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>4,'start_time'=>Carbon::create(2022,5,21,11,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,21,16,0,0)->toDateTimeString()],
            ['rota_id'=>1,'staff_id'=>3,'start_time'=>Carbon::create(2022,5,21,12,0,0)->toDateTimeString(),'end_time'=>Carbon::create(2022,5,21,17,0,0)->toDateTimeString()],
        ];
        foreach($weeklyShifts as $shift)
        {
            DB::table('shifts')->insert([
                'rota_id'=>$shift['rota_id'],
                'staff_id'=>$shift['staff_id'],
                'start_time'=>$shift['start_time'],
                'end_time'=>$shift['end_time']
            ]);
        }
        
    }
}
