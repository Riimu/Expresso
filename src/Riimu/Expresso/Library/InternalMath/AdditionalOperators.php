<?php

namespace Riimu\Expresso\Library\InternalMath;

Use Riimu\Expresso\Context\ArgumentContext as Arguments;
Use Riimu\Expresso\Library\Operator as Op;
Use Riimu\Expresso\Number\Internal\Number;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class AdditionalOperators extends \Riimu\Expresso\Library\Library
{
    protected $operators = [
        ['power', '^', '^', Op::BINARY, Op::RIGHT, Op::PREC_POWER],
        ['factorial', '$!', '!', Op::UNARY, Op::LEFT, Op::PREC_FACTORIAL],
    ];

    public static function power (Arguments $arg)
    {
        return new Number(pow($arg->getReal(0), $arg->getReal(1)));
    }

    public static function factorial (Arguments $arg)
    {
        $n = (int) $arg->getReal(0);

        if ($n < 0) {
            $arg->throwException("Factorial is only defined for positive integers");
        } elseif ($n == 0) {
            $result = 1;
        } else {
            for ($result = $n--; $n > 1; $n--) {
                $result *= $n;
            }
        }

        return new Number($result);
    }
}
