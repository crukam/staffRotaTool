<?php
namespace App\CustomClass;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class SingleManningRota
{
    /**
     * Format the start and end string datetime
     * 
     * @param string $dateTime
     * 
     * @return array dateTime 
     */
    private function formatDateTimeString($datetime)
    {
        $dateTimeYMD =  explode('-',$datetime);
        $year = $dateTimeYMD[0];
        $month = $dateTimeYMD[1];
        $day = explode(' ',$dateTimeYMD[2])[0];
        $hour = explode(':',explode(' ',$dateTimeYMD[2])[1])[0];
        $minutes = explode(':',explode(' ',$dateTimeYMD[2])[1])[1];
        $seconds = explode(':',explode(' ',$dateTimeYMD[2])[1])[2];
        
        return Carbon::create( $year, $month, $day,$hour,$minutes,$seconds);
        
    }
    /**
     * Get staff on rota for a given day
     * 
     * @param string $date (y-m-d)
     * 
     * @return array of staffs
     */
    public function getDayWorkingStaff($date)
    {
       
        $dt = Carbon::create( explode('-',$date)[0], explode('-',$date)[1], explode('-',$date)[2],0,0,0);
        return DB::table('staff')
            ->join('shifts','staff.id','=','shifts.staff_id')
            ->whereDate('shifts.start_time','=',$dt)
            ->select('staff.id','staff.first_name','shifts.start_time','shifts.end_time')
            ->orderBy('shifts.start_time','desc')
            ->get();
    }

    /**
     * Get daily single mannning supplement
     * 
     * @param string $date (Y-m-d)
     * 
     * @return @return Illuminate\Support\Collection
     */
    public function getDailySingleManning($date)
    {
        $staff = $this->getDayWorkingStaff($date);
        
        $start = $this->formatDateTimeString($staff[0]->start_time);
       $end = $this->formatDateTimeString($staff[0]->end_time);
        return  $end->diffInMinutes($start);
    }
}