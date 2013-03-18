<?php

namespace Tests\Expression;

use Helpers\Builder as Build;
use Riimu\Expresso\Expression\Expression;
use Riimu\Expresso\Expression\Call;
use Riimu\Expresso\Number\Internal\Number;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class ExpressionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetReal()
    {
        $exp = new Expression([new Number(42)], Build::standardContext());
        $this->assertEquals(42, $exp->getReal());
    }

    /* TEST EXCEPTION CASES */

    /**
     * @expectedException \RuntimeException
     */
    public function testInvalidStack()
    {
        $number = new Number(42);
        $exp = new Expression([$number, $number], Build::standardContext());
        $exp->evaluate();
    }

    /**
     * @expectedException \UnderflowException
     */
    public function testShortStack()
    {
        $call = new Call('intval', 'i', 1);
        $exp = new Expression([$call], Build::standardContext());
        $exp->evaluate();
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidCallReturnValue()
    {
        $call = new Call(function () { return 0; }, 'i', 0);
        $exp = new Expression([$call], Build::standardContext());
        $exp->evaluate();
    }
}
