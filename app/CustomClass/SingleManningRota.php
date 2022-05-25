<?php
namespace App\CustomClass;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class SingleManningRota
{
    private $rota;
    
    /**
     * set rota value
     */
    public function setRota($rota)
    {
        $this->rota = $rota;
    }

    /**
     * get rota value
     */
    public function getRota()
    {
        return $this->rota;
    }
    
    /**
     * Format the start and end string datetime
     * 
     * @param string $dateTime
     * 
     * @return array dateTime 
     */
    private function formatDateTimeString($datetime)
    {
        //clear any string after second
        if(strpos($datetime,'.') != false){
            list($datetime,$remainString) = explode('.', $datetime, 4);
        }
        
        
        $dateTimeYMD =  explode('-',$datetime);
        $year = $dateTimeYMD[0];
        $month = $dateTimeYMD[1];
        $day = explode(' ',$dateTimeYMD[2])[0];
    
        if(strpos($datetime,':') != false){
            $hour = explode(':',explode(' ',$dateTimeYMD[2])[1])[0];
            $minutes = explode(':',explode(' ',$dateTimeYMD[2])[1])[1];
            $seconds = explode(':',explode(' ',$dateTimeYMD[2])[1])[2];
        } else {
            $hour=0;
            $minutes=0;
            $seconds=0;
        }

        
        
       
        
        return Carbon::create( $year, $month, $day,$hour,$minutes,$seconds);
        
    }
    /**
     * Get staff on rota for a given day
     * 
     * @param string $date (y-m-d)
     * 
     * @return Illuminate\Support\Collection
     */
    public function getDayWorkingStaff($date)
    {
        $dt = $this->formatDateTimeString($date);
        
        return DB::table('staff')
            ->join('shifts','staff.id','=','shifts.staff_id')
            ->whereDate('shifts.start_time','=',$dt)
            ->select('staff.id','staff.first_name','shifts.start_time','shifts.end_time')
            ->orderBy('shifts.start_time','asc')
            ->get();
    }

    /**
     * Get daily single mannning supplement
     * 
     * @param string $date (Y-m-d)
     * 
     * @return  integer (minutes)
     */
    public function getDailySingleManning($date)
    {
        $staffs = $this->getDayWorkingStaff($date);
        $shiftsTimes = array();
        
       //grap staff on shift start and end time
       
       foreach($staffs as $staff){
            $shiftsTimes[] = $this->formatDateTimeString($staff->start_time);;
            $shiftsTimes[] = $this->formatDateTimeString($staff->end_time); 
        }
       
        //sort the dates by ascending order
       
        usort($shiftsTimes, function($t0,$t1){
            return (strtotime($t0) < strtotime($t1)) ? 1 : ((strtotime($t0) > strtotime($t1))? -1 : 0);
        });
     
        //calculate the single maning payment for the day
        if(COUNT($staffs) > 1)
        {
            $result = $shiftsTimes[COUNT($shiftsTimes)-1]->diffInMinutes($shiftsTimes[0]) - $shiftsTimes[COUNT($shiftsTimes)-2]->diffInMinutes($shiftsTimes[1]);
        }
       
        if(COUNT($staffs) == 1)
        {
            $result = $shiftsTimes[COUNT($shiftsTimes)-1]->diffInMinutes($shiftsTimes[0]);
        }
       
        return $result;
    }
    /**
     * Calculate weekly rota single minning payment
     * @param integer $rotaId
     * 
     * @return integer $singleManning 
     */
    public function calculateWeeklySingleManning()
    {
        //init variable
        $startWeek = $this->formatDateTimeString($this->rota->week_commence_date);
        $endWeek = $this->formatDateTimeString($this->rota->week_commence_date)->addDays(5);
        $singleMannings = [];
        $dt = $startWeek;
       
        //run through the date of the week
        while($dt->lt($endWeek))
        {
            
            $singleMannings[] = [
                'date'=>$dt->toDayDateTimeString(),
                'singleCalculation'=>$this->getDailySingleManning($dt->toDateTimeString())
            ];
            
            $dt=$dt->addDay();
        }
        
        
        return   $singleMannings;
    }
}