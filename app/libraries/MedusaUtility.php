<?php
/**
 * Created by PhpStorm.
 * User: dweiner
 * Date: 10/13/16
 * Time: 5:14 PM
 */

namespace Medusa\Utility;

class MedusaUtility
{

    /**
     * Return the spelled out ordinal (First, Second, Third, etc) of a number
     * @param $value
     *
     * @return string
     */

    public static function ordinal($value)
    {
        $ordinal = new \NumberFormatter('en_US', \NumberFormatter::SPELLOUT);
        $ordinal->setTextAttribute(\NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal");
        return ucfirst($ordinal->format($value));
    }
}