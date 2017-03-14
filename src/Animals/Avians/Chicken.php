<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-13
 * Time: 23:42
 */

namespace ExposureSoftware\SuperChicken\Animals\Avians;


use ExposureSoftware\SuperChicken\Exceptions\InterspeciesBreeding;
use ExposureSoftware\SuperChicken\Exceptions\Necromancy;
use ExposureSoftware\SuperChicken\Interfaces\Animal;
use ExposureSoftware\SuperChicken\Traits\MakesNoise;

class Chicken extends Bird
{
    use MakesNoise;

    /** @var bool $satiated */
    private $satiated = false;
    /** @var int $weight */
    private $weight = 1;

    public function __construct(bool $male = null)
    {
        if (is_null($male)) {
            $male = (bool)mt_rand(0, 1);
        }

        $this->is_male = $male;
    }

    /**
     * @param Animal $mate
     *
     * @return Animal
     * @throws \Exception
     */
    public function reproduce(Animal $mate)
    {
        if ($this->isDead()) {

        }

        if (!$mate instanceof Chicken) {
            throw new InterspeciesBreeding('That\s just wrong, weirdo!');
        }

        return new Chicken();
    }

    /**
     * Consumes units of food.
     * Each day a Chicken will eat its weight in food. They're HUNGRY birds.
     *
     * @param int $units
     *
     * @return int
     */
    public function eat(int $units)
    {
        $this->checkIfLiving();
        $this->satiated = $this->weight <= $units;
        $this->grow();

        return $units;
    }

    /**
     * The Chicken grows.
     */
    public function grow()
    {
        $this->checkIfLiving();
        parent::grow();
        $this->weight += 1;
    }

    /**
     * Determines if the Chicken has eaten enough.
     *
     * @return bool
     */
    public function isStarving()
    {
        $this->checkIfLiving();
        return !$this->satiated;
    }

    /**
     * A male Chicken is a rooster. A female is a hen.
     *
     * @return bool
     */
    public function isRooster()
    {
        return $this->is_male;
    }

    /**
     * The Chicken came first, obviously.
     *
     * @return bool
     */
    public function laidEgg()
    {
        $this->checkIfLiving();
        $laid = false;
        if (!$this->isRooster() && mt_rand(0, 1)) {
            $laid = true;
        }

        return $laid;
    }

    /**
     * @return string
     */
    public function vocalize()
    {
        return $this->isRooster() ? 'cockadoodledoo' : 'squawk';
    }

    /**
     * Has the bird eaten its fill?
     *
     * @return bool
     */
    public function satiated()
    {
        return $this->satiated;
    }

    /**
     * @throws Necromancy
     */
    private function checkIfLiving()
    {
        if ($this->isDead()) {
            throw new Necromancy('It\'s dead, Jim.');
        }
    }
}
