<?php

namespace Riimu\Expresso\Expression;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
abstract class Number extends Value
{
    public function getPrimitive()
    {
        return $this->getReal();
    }
}
