<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-13
 * Time: 23:47
 */

namespace ExposureSoftware\SuperChicken\Animals;


use \ExposureSoftware\SuperChicken\Interfaces\Animal as AnimalInterface;

abstract class Animal implements AnimalInterface
{
    /** @var bool $is_male */
    protected $is_male = false;
    /** @var bool $is_dead */
    protected $is_dead = false;
    /** @var int $age */
    protected $age = 0;

    /**
     * Checks if the Animal has died.
     */
    public function isDead()
    {
        return $this->is_dead;
    }

    /**
     * Forces the Animal into the afterlife.
     *
     * @return void
     */
    public function expire()
    {
        $this->is_dead = true;
    }

    /**
     * Ages the Animal.
     */
    public function grow()
    {
        $this->age += 1;
    }
}
