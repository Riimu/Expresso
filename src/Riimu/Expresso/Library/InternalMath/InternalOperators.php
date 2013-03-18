<?php

namespace Riimu\Expresso\Library\InternalMath;

use Riimu\Expresso\Context\ArgumentContext as Arguments;
use Riimu\Expresso\Library\Operator as Op;
use Riimu\Expresso\Number\Internal\Number;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class InternalOperators extends \Riimu\Expresso\Library\Library
{
    protected $operators = [
        ['sum', '+', '+', Op::BINARY, Op::LEFT, Op::PREC_SUM_DIFFERENCE],
        ['difference', '-', '-', Op::BINARY, Op::LEFT, Op::PREC_SUM_DIFFERENCE],
        ['product', '*', '*', Op::BINARY, Op::LEFT, Op::PREC_PRODUCT_QUOTIENT],
        ['quotient', '/', '/', Op::BINARY, Op::LEFT, Op::PREC_PRODUCT_QUOTIENT],
        ['positive', '+$', '+', Op::UNARY, Op::RIGHT, Op::PREC_MINUS_PLUS],
        ['negative', '-$', '-', Op::UNARY, Op::RIGHT, Op::PREC_MINUS_PLUS],
    ];

    public static function sum(Arguments $arg)
    {
        return new Number($arg->getReal(0) + $arg->getReal(1));
    }

    public static function difference(Arguments $arg)
    {
        return new Number($arg->getReal(0) - $arg->getReal(1));
    }

    public static function product(Arguments $arg)
    {
        return new Number($arg->getReal(0) * $arg->getReal(1));
    }

    public static function quotient(Arguments $arg)
    {
        return new Number($arg->getReal(0) / $arg->getReal(1));
    }

    public static function positive(Arguments $arg)
    {
        return new Number(+$arg->getReal(0));
    }

    public static function negative(Arguments $arg)
    {
        return new Number(-$arg->getReal(0));
    }
}
