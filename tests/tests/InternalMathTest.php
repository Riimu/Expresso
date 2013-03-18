<?php

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class InternalMathTest extends ExpressionTestBase
{
    public function testSum()
    {
        $this->assertExpression(136, '37 + 99');
    }

    public function testDifference()
    {
        $this->assertExpression(-2, '6 - 8');
    }

    public function testProduct()
    {
        $this->assertExpression(27, '3 * 9');
    }

    public function testQuotient()
    {
        $this->assertExpression(3, '27 / 9');
    }
}
