<?php

use Tests\TestCase;
use App\CustomClass\SingleManningRota;
use App\CustomClass\Staff;

class SingleManningRotaTest extends TestCase
{
    
    /**
     * Test Black is on Monday shift
     */
    public function testBlackWorkMonday()
    {
        $singleManningRota = new SingleManningRota();
        $staff = new Staff();
        $mondayStaffs = $singleManningRota->getDayWorkingStaff('2022-05-16');
        $BlackStaff = $staff->getStaffByname('Black');
        $this->assertEquals($BlackStaff[0]->id,$mondayStaffs[0]->id,'Black is not in the collection of Monday rota');
    }
   
    /**
     * Test monday shift has one staff
     * 
     */
    public function testMondayShiftHasOneStaff()
    {
        $singleManningRota = new SingleManningRota();
        $mondayShiftStaff = $singleManningRota->getDayWorkingStaff('2022-05-16');
        $this->assertEquals($mondayShiftStaff->count(),1,'number of staff is more than one on Monday');
    }
    /**
     * test monday dailySingleManning equal 480
     */
    public function testMondayDailySingleManning()
    {
        $singleManningRota = new SingleManningRota();
        $mondayShiftStaff = $singleManningRota->getDayWorkingStaff('2022-05-16');
        $singleManning = $singleManningRota->getDailySingleManning('2022-05-16');
        $this->assertEquals($singleManning,480, 'the single manning calculation for monday is unexpected');
     }
}