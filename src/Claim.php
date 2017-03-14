<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-13
 * Time: 22:30
 */

namespace ExposureSoftware\SuperChicken;


use ExposureSoftware\SuperChicken\Animals\Avians\Chicken;
use Illuminate\Support\Collection;

/**
 * Class Claim
 *
 * @package ExposureSoftware\SuperChicken
 */
class Claim
{
    /** @var int $acres */
    private $acres;
    /** @var Collection $hens */
    private $hens;
    /** @var Collection $roosters */
    private $roosters;

    /**
     * Claim constructor.
     *
     * @param int  $acres
     * @param bool $populate
     */
    public function __construct(int $acres, bool $populate = true)
    {
        $this->acres = $acres;
        $this->hens = collect();
        $this->roosters = collect();

        if ($populate) {
            $this->populate();
        }
    }

    /**
     * Retrieves all the chickens on this Claim.
     *
     * @return Collection
     */
    public function chickens()
    {
        return $this->hens->merge($this->roosters)->reject(function (Chicken $chicken) {
            return $chicken->isDead();
        });
    }

    /**
     * @return int
     */
    public function size()
    {
        return $this->acres;
    }

    /**
     * The miracle of life.
     *
     * @return Chicken
     */
    public function hatchEgg()
    {
        $chick = new Chicken();

        if ($chick->isRooster()) {
            $this->roosters->push($chick);
        } else {
            $this->hens->push($chick);
        }

        return $chick;
    }

    /**
     * Populates the claim.
     *
     * According to http://www.plamondon.com/wp/how-many-chickens-per-acre/ the ideal number is 50
     * chickens per acre. Therefor the claim will be populated up to that limit.
     *
     * @return Collection
     */
    private function populate()
    {
        if ($this->chickens()->isEmpty()) {
            $hens = mt_rand(1, 49) * $this->acres;
            for($i = 1; $i <= $hens; $i++) {
                $this->hens->push(new Chicken(false));
            }
            $this->roosters->push(new Chicken(true));
        }

        return $this->chickens();
    }
}
