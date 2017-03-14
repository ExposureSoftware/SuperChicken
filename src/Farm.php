<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-13
 * Time: 22:08
 */

namespace ExposureSoftware\SuperChicken;


use ExposureSoftware\SuperChicken\Animals\Avians\Chicken;
use ExposureSoftware\SuperChicken\Exceptions\Necromancy;
use Illuminate\Support\Collection;

/**
 * Class Farm
 *
 * @package ExposureSoftware\SuperChicken
 */
class Farm
{
    /** @var Collection $claims */
    private $claims;
    /** @var bool $hot_chicks */
    private $hot_chicks = false;
    /** @var int $units_food */
    private $units_food = 0;

    /**
     * Farm constructor.
     *
     * @param int|null $acres
     */
    public function __construct(int $acres = null)
    {
        $this->claims = collect();
        $this->stakeClaim($acres ?: 1);
    }

    /**
     * Starts a new farm.
     *
     * @param int  $acres
     * @param bool $populate
     *
     * @return Claim
     */
    public function stakeClaim(int $acres, bool $populate = true)
    {
        $claim = new Claim($acres, $populate);
        $this->claims->push($claim);

        return $claim;
    }

    /**
     * Returns the size of the farm in total.
     *
     * @return int
     */
    public function size()
    {
        return $this->claims->sum(function (Claim $claim) {
            return $claim->size();
        });
    }

    /**
     * Returns the total population in Chickens.
     *
     * @return int
     */
    public function population()
    {
        return $this->chickens()->count();
    }

    /**
     * Feeds as many Chickens to their heart's desire as possible with current food supply.
     */
    public function feed()
    {
        $this->claims->each(function (Claim $claim) {
            $claim->chickens()->each(function (Chicken $chicken) {
                $satiated = false;
                while (!$satiated && $this->units_food > 0) {
                    try {
                        $chicken->eat(1);
                        $satiated = $chicken->satiated();

                    } catch (Necromancy $exception) {
                        continue;
                    }
                    $this->units_food -= 1;
                };
            });
        });
    }

    /**
     * Adds food units to the Farm.
     *
     * @param int $units_food
     *
     * @return int
     */
    public function store(int $units_food)
    {
        $this->units_food += $units_food;

        return $this->units_food;
    }

    /**
     * Returns the number of food units stored in the Farm.
     *
     * @return int
     */
    public function foodSupply()
    {
        return $this->units_food;
    }

    /**
     * Sets the farm to a heightened reproductive state.
     * OK, this variable is a little silly.
     *
     * @param bool $giggity
     *
     * @return bool
     */
    public function stimulated(bool $giggity = null)
    {
        if (!is_null($giggity)) {
            $this->hot_chicks = $giggity;
        }

        return $this->hot_chicks;
    }

    /**
     * Retrieves all the Chickens in all the Claims of the Farm.
     *
     * @return Collection
     */
    public function chickens()
    {
        $chickens = collect();
        $this->claims->each(function (Claim $claim) use (&$chickens) {
            $chickens = $chickens->merge($claim->chickens());
        });

        return $chickens;
    }

    /**
     * Returns the number of eggs laid by the Farm's Chickens.
     *
     * @return int
     */
    public function collectEggs()
    {
        return $this->chickens()->sum(function (Chicken $chicken) {
            return $chicken->laidEgg() ? 1 : 0;
        });
    }

    /**
     * Murders the given number of Chickens.
     *
     * @param int $chickens
     */
    public function cull(int $chickens)
    {
        for ($i = 0; $i < $chickens; $i++) {
            $this->claims->random()->chickens()->random()->expire();
        }
    }

    /**
     * Randomly spawn a Chicken.
     *
     * @return Chicken
     */
    public function hatchEgg()
    {
        $this->stimulated(false);
        return $this->claims->random()->hatchEgg();
    }
}
