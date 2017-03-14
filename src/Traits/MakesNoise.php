<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 2017-03-14
 * Time: 01:54
 */

namespace ExposureSoftware\SuperChicken\Traits;


/**
 * Class MakesNoise
 *
 * @package ExposureSoftware\SuperChicken\Traits
 */
trait MakesNoise
{
    /**
     * @return string
     */
    public function vocalize()
    {
        return isset($this->sound) ? $this->sound : '';
    }
}
