<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-14
 * Time: 03:00
 */

namespace Tests;


use ExposureSoftware\SuperChicken\Animals\Avians\Chicken;
use ExposureSoftware\SuperChicken\Animals\Mammals\Fox;
use ExposureSoftware\SuperChicken\Exceptions\InterspeciesBreeding;
use ExposureSoftware\SuperChicken\Farm;
use PHPUnit\Framework\TestCase;

class FoxTest extends TestCase
{
    public function testExistence()
    {
        $this->assertInstanceOf(Fox::class, new Fox());
    }

    public function testReproduce()
    {
        $this->assertInstanceOf(Fox::class, (new Fox())->reproduce(new Fox()));
    }

    public function testReproduceWithWrongSpecies()
    {
        $this->expectException(InterspeciesBreeding::class);

        (new Fox())->reproduce(new Chicken());
    }

    public function testHunt()
    {
        $this->assertTrue(is_bool((new Fox())->hunt(new Farm())));
    }

    public function testMakeNoise()
    {
        $this->assertEquals('growl', (new Fox())->vocalize());
    }

    public function testEat()
    {
        $this->assertTrue(is_int((new Fox())->eat(2)));
    }

    public function testIsStarving()
    {
        $this->assertTrue(is_bool((new Fox())->isStarving()));
    }

    public function testExpire()
    {
        $fox = new Fox();

        $this->assertFalse($fox->isDead());

        $fox->expire();

        $this->assertTrue($fox->isDead());
    }
}
