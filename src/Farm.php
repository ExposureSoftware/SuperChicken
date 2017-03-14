<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-13
 * Time: 22:08
 */

namespace ExposureSoftware\SuperChicken;


use ExposureSoftware\SuperChicken\Animals\Avians\Chicken;
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
        $this->stakeClaim($acres ?: mt_rand(1, 20));
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
        return $this->claims->sum(function (Claim $claim) {
            return $claim->chickens()->count();
        });
    }

    public function feed()
    {
        $this->claims->each(function (Claim $claim) {
            $claim->chickens()->each(function (Chicken $chicken) {
                do {
                    $satiated = $chicken->eat(1);
                    $this->units_food -= 1;
                } while (!$satiated && $this->units_food > 0);
            });
        });
    }

    /**
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
     * @return int
     */
    public function foodSupply()
    {
        return $this->units_food;
    }
}
