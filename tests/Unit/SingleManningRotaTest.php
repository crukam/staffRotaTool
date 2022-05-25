<?php

use Tests\TestCase;
use App\CustomClass\SingleManningRota;
use App\CustomClass\Staff;
use App\CustomClass\Rota;

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
        $singleManning = $singleManningRota->getDailySingleManning('2022-05-16');
         $this->assertEquals($singleManning,480, 'the single manning calculation for monday is unexpected');
       
     }
     /**
      * test only Black and Thor are working on Tuesday
      */
    public function testBlackAndThorWorkTuesday()
    {
        $singleManningRota = new SingleManningRota();
        $staff = new Staff();
        $tuesdayStaffs = $singleManningRota->getDayWorkingStaff('2022-05-17');
        $blackStaff = $staff->getStaffByname('Black');
        $this->assertEquals($blackStaff[0]->id,$tuesdayStaffs[0]->id,'Black is not in the collection of Tuesday rota');
        $thorStaff = $staff->getStaffByname('Thor');
        $this->assertEquals($thorStaff[0]->id,$tuesdayStaffs[1]->id,'Thorn is not in the collection of Tuesday rota');
    }
    /**
     * test Black and Thor received single manning for the whole work shift on tuesday(480)
     */
    public function testBlackAndThorReceiveMaxManning()
    {
        $singleManningRota = new SingleManningRota();
        $singleManning = $singleManningRota->getDailySingleManning('2022-05-17');
        $this->assertEquals($singleManning,480, 'the single manning calculation for monday is unexpected');
    }
    /**
     * check Wednesdayshift is as expected
     * 
     */
    public function testWednesdayShift()
    {
        $singleManningRota = new SingleManningRota();
        $staff = new Staff();
        $wednesdayStaffs = $singleManningRota->getDayWorkingStaff('2022-05-18');
        $getWolverine = $staff->getStaffByname('Wolverine');
        $this->assertEquals($getWolverine[0]->id,$wednesdayStaffs[0]->id,'Wolverine is not in the collection of Wednesday rota');
        $getGamora = $staff->getStaffByname('Gamora');
        $this->assertEquals($getGamora[0]->id,$wednesdayStaffs[1]->id,'Gamora is not in the staffs for Wednesday rota');

    }
    /**
     * Test Wednesday daily single maning (<480)
     */
    public function testWednesdaySinglemanning()
    {
        $singleManningRota = new SingleManningRota();
        $singleManning = $singleManningRota->getDailySingleManning('2022-05-18');
        $this->assertEquals($singleManning,240, 'the single manning calculation for wednesday is unexpected');
    }
    /**
     * Test date from rota is in the right type
     */
    public function testDateFromRotaField()
    {
        $rota = Rota::getRotaById(1);
        $this->assertTrue(is_string($rota->week_commence_date));
    }
    /**
     * Test calculateWeeklySingleManning output
     */
    public function testcalculateWeeklySingleManning()
    {
        $singleManningRota = new SingleManningRota();
        $rota = Rota::getRotaById(1);
        $singleManningRota->setRota($rota);
        $getRota = $singleManningRota->getRota();
        $result = $singleManningRota->calculateWeeklySingleManning($rota->week_commence_date);
        $this->assertIsArray($result,'The result is not an array');
    }
}