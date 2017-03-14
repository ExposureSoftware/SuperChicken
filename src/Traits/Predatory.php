<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-14
 * Time: 02:07
 */

namespace ExposureSoftware\SuperChicken\Traits;


use ExposureSoftware\SuperChicken\Farm;

/**
 * Class Predatory
 *
 * @package ExposureSoftware\SuperChicken\Traits
 */
trait Predatory
{
    /**
     * Stalks a given Farm for food.
     *
     * @param Farm $farm
     *
     * @return bool
     */
    public function hunt(Farm $farm)
    {
        $successful = false;

        if (mt_rand(1, 6) > 4) {
            $successful = true;
            $farm->cull(1);
        }

        return $successful;
    }
}
