<?php

namespace Tests\Unit;

use Tests\TestCase;
//use PHPUnit\Framework\TestCase;
use App\CustomClass\Staff;

class StaffTest extends TestCase
{
   
    /**
     * Test getAll staff
     * 
     * @return void
     */
    public function testGetAll()
    {
        $staff = new Staff();
        $this->assertIsObject($staff);
        //test all return an array of staff object
        $staffs = $staff->all();
        $this->assertEquals(4,$staffs->count(),'the number of staff returned is different to what is expected');
    }
    /**
     * Test staff returned from the datapage are object type
     * 
     * @return void
     */
    public function testStaffIsObject()
    {
        $staff = new Staff();
        $staffs = $staff->all();
        $this->assertIsObject($staffs[0]);
    }
    /**
     * Test staff to return a staff by name
     * 
     * @return void
     */
    public function testGetStaffByname()
    {
        $staff = new Staff();
        $staffs = $staff->getStaffByname('Black');
        $this->assertEquals('Black',$staffs[0]->first_name,'the staff does have a different name');
    }
}
