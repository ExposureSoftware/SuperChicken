<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-14
 * Time: 01:44
 */

namespace ExposureSoftware\SuperChicken;


use ExposureSoftware\SuperChicken\Animals\Avians\Chicken;
use ExposureSoftware\SuperChicken\Animals\Mammals\Fox;
use ExposureSoftware\SuperChicken\Animals\Predator;
use Illuminate\Support\Collection;

class Night
{
    /** @var int $successful_hunts */
    private $successful_hunts = 0;
    /** @var Collection $noises */
    private $noises;
    /** @var Farm $farm */
    private $farm;
    /** @var int $starved_chickens */
    private $starved_chickens = 0;

    public function __construct(Farm $farm)
    {
        $this->noises = collect();
        $this->farm = $farm;
    }

    /**
     * Simulates a night on a given Farm.
     *
     * @return Collection
     */
    public function fall()
    {
        return collect([
            'successful_hunts' => $this->wakeNocturnalAnimals(),
            'noises'           => $this->noises(),
            'starved_chickens' => $this->digestFood(),
        ]);
    }

    /**
     * Determines if sleeping animals wake and hunt.
     */
    private function wakeNocturnalAnimals()
    {
        $predators = collect();

        for ($i = 0; $i < mt_rand(0, 3); $i++) {
            $predators->push(new Fox());
        }

        $this->successful_hunts = $predators->sum(function (Predator $predator) {
            return $predator->hunt($this->farm) ? 1 : 0;
        });

        return $this->successful_hunts;
    }

    /**
     * Determines what if any noises are made in the night.
     */
    private function noises()
    {
        if ($this->successful_hunts > 0) {
            $this->noises->push((new Fox())->vocalize());
        }

        if (mt_rand(1, 20) > 12) {
            $this->noises->push($this->farm->chickens()->random()->vocalize());
        }

        return $this->noises;
    }

    /**
     * Allows the Chickens time to metabolise their feed.
     */
    private function digestFood()
    {
        $starved_chickens = $this->farm->chickens()->filter(function (Chicken $chicken) {
            $starved = false;

            if ($chicken->isStarving()) {
                $chicken->expire();
                $this->starved_chickens += 1;
                $starved = true;
            }

            return $starved;
        });

        return $starved_chickens->count();
    }
}
