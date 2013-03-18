<?php

namespace Riimu\Expresso\Number\Internal;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Number extends \Riimu\Expresso\Number\Number
{
    private $value;

    public function __construct($value)
    {
        if (!is_int($value) && !is_float($value)) {
            throw new \InvalidArgumentException("Internal number must be integer or float");
        }

        $this->value = $value;
    }

    public function getReal()
    {
        return $this->value;
    }

    public function getRPNToken()
    {
        return (string) $this->value;
    }
}
