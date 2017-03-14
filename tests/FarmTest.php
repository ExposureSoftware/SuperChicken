<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-13
 * Time: 22:01
 */

namespace Tests;


use ExposureSoftware\SuperChicken\Claim;
use ExposureSoftware\SuperChicken\Farm;
use PHPUnit\Framework\TestCase;

class FarmTest extends TestCase
{
    public function testCreation()
    {
        $farm = new Farm();

        $this->assertInstanceOf(Farm::class, $farm);
    }

    public function testStakeClaim()
    {
        $farm = new Farm();
        $this->assertInstanceOf(Claim::class, $farm->stakeClaim(1));
    }

    public function testSize()
    {
        $this->assertTrue(is_int((new Farm())->size()));
    }

    public function testPopulation()
    {
        $this->assertTrue(is_int((new Farm())->population()));
    }

    public function testStore()
    {
        $farm = new Farm();
        $pellets = 10;
        $previous = $farm->foodSupply();

        $farm->store($pellets);
        $this->assertEquals($pellets + $previous, $farm->foodSupply());
    }

    public function testFoodSupply()
    {
        $this->assertTrue(is_int((new Farm())->foodSupply()));
    }
}
