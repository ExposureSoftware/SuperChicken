<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-13
 * Time: 23:05
 */

namespace ExposureSoftware\SuperChicken\Interfaces;


interface Animal
{
    /**
     * @param Animal $mate
     *
     * @return Animal
     * @throws \Exception
     */
    public function reproduce(Animal $mate);

    /**
     * @return void
     */
    public function expire();

    /**
     * @param int $units
     *
     * @return int
     */
    public function eat(int $units);

    public function grow();

    /**
     * @return bool
     */
    public function isDead();

    public function isStarving();
}
