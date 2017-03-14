<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-14
 * Time: 02:05
 */

namespace ExposureSoftware\SuperChicken\Animals\Mammals;


use ExposureSoftware\SuperChicken\Animals\Predator;
use ExposureSoftware\SuperChicken\Exceptions\InterspeciesBreeding;
use ExposureSoftware\SuperChicken\Interfaces\Animal;
use ExposureSoftware\SuperChicken\Traits\MakesNoise;

class Fox extends Predator
{
    use MakesNoise;

    /** @var string $sound */
    protected $sound = 'growl';

    /**
     * @param Animal $mate
     *
     * @return Animal
     * @throws \Exception
     */
    public function reproduce(Animal $mate)
    {
        if (!$mate instanceof Fox) {
            throw new InterspeciesBreeding('Wrong type of mate.');
        }

        return new Fox();
    }

    /**
     * @param int $units
     *
     * @return int
     */
    public function eat(int $units)
    {
        return 1;
    }

    public function isStarving()
    {
        return true; // Foxes have it rough, never enough food.
}}
