<?php

namespace Tests\Context;

use Riimu\Expresso\Context\NamespaceContext;
use Riimu\Expresso\Library\Operator as Op;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class NamespaceContextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDuplicateInfixToken()
    {
        $namespace = new NamespaceContext();
        $namespace->addOperator('intval', 'a', 'a', Op::BINARY, Op::LEFT, Op::PREC_SUM_DIFFERENCE);
        $namespace->addOperator('intval', 'b', 'a', Op::BINARY, Op::LEFT, Op::PREC_SUM_DIFFERENCE);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testDuplicateRPNToken()
    {
        $namespace = new NamespaceContext();
        $namespace->addOperator('intval', 'a', 'a', Op::BINARY, Op::LEFT, Op::PREC_SUM_DIFFERENCE);
        $namespace->addOperator('intval', 'a', 'b', Op::BINARY, Op::LEFT, Op::PREC_SUM_DIFFERENCE);
    }
}
