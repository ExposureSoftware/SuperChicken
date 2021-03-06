<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-14
 * Time: 03:16
 */

namespace Tests;


use ExposureSoftware\SuperChicken\Animals\Avians\Chicken;
use ExposureSoftware\SuperChicken\Claim;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class ClaimTest extends TestCase
{
    public function testExistence()
    {
        $this->assertInstanceOf(Claim::class, new Claim(3));
    }

    public function testChickens()
    {
        $this->assertInstanceOf(Collection::class, (new Claim(3))->chickens());
    }

    public function testSize()
    {
        $this->assertTrue(is_int((new Claim(1))->size()));
    }

    public function testHatchEgg()
    {
        $claim = new Claim(2);
        $population = $claim->chickens()->count();

        $this->assertInstanceOf(Chicken::class, $claim->hatchEgg());
        $this->assertEquals($population + 1, $claim->chickens()->count());
    }
}
