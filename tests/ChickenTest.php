<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-14
 * Time: 03:09
 */

namespace Tests;


use ExposureSoftware\SuperChicken\Animals\Avians\Chicken;
use ExposureSoftware\SuperChicken\Animals\Mammals\Fox;
use ExposureSoftware\SuperChicken\Exceptions\InterspeciesBreeding;
use PHPUnit\Framework\TestCase;

class ChickenTest extends TestCase
{
    public function testExistence()
    {
        $this->assertInstanceOf(Chicken::class, new Chicken());
    }

    public function testReproduce()
    {
        $this->assertInstanceOf(Chicken::class, (new Chicken())->reproduce(new Chicken()));
    }

    public function testReproduceWithWrongSpecies()
    {
        $this->expectException(InterspeciesBreeding::class);

        (new Chicken())->reproduce(new Fox());
    }

    public function testMakeNoise()
    {
        $rooster = new Chicken(true);
        $hen = new Chicken(false);

        $this->assertTrue('cockadoodledoo' === $rooster->vocalize());
        $this->assertTrue('squawk' === $hen->vocalize());
    }

    public function testEat()
    {
        $this->assertTrue(is_int((new Chicken())->eat(2)));
    }

    public function testIsStarving()
    {
        $this->assertTrue(is_bool((new Chicken())->isStarving()));
    }

    public function testExpire()
    {
        $chicken = new Chicken();

        $this->assertFalse($chicken->isDead());

        $chicken->expire();

        $this->assertTrue($chicken->isDead());
    }
}
