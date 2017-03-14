<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-14
 * Time: 02:53
 */

namespace Tests;


use ExposureSoftware\SuperChicken\Farm;
use ExposureSoftware\SuperChicken\Night;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class NightTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(Night::class, new Night(new Farm()));
    }

    public function testFall()
    {
        $night = new Night(new Farm());

        $result = $night->fall();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertTrue($result->has('successful_hunts') && is_int($result->get('successful_hunts')));
        $this->assertTrue($result->has('noises') && $result->get('noises') instanceof Collection);
        $this->assertTrue($result->has('starved_chickens') && is_int($result->get('starved_chickens')));
    }
}
