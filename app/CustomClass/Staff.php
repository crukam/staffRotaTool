<?php
namespace App\CustomClass;
use Illuminate\Support\Facades\DB;

class Staff
{
    /**
     * Get all staff working for funHouse
     * @param void
     * 
     * @return Illuminate\Support\Collection
     */
    public function all()
    {
        return DB::table('staff')->get();
    }
    
    /**
     * Get staff by the first name
     * @param string $name
     * 
     * @return Illuminate\Support\Collection
     */
    public function getStaffByname($name)
    {
        return DB::table('staff')->where('first_name',$name)->get();
    }
}