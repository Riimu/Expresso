<?php

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class InternalMathTest extends PHPUnit_Framework_TestCase
{
    use \Helpers\ExpressionTester;

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

    public function testPower()
    {
        $this->assertExpression(256, '2 ^ 8');
    }

    public function testNegation()
    {
        $this->assertExpression(66, '- -66');
        $this->assertExpression(-55, '- 55');
    }

    public function testPositive()
    {
        $this->assertExpression(-42, '+ -42');
        $this->assertExpression(32, '+ 32');
    }

    public function testFactorial()
    {
        $this->assertExpression(120, '5!');
        $this->assertExpression(1, '0!');
    }

    /**
     * @expectedException Riimu\Expresso\Library\ArgumentsException
     */
    public function testFactorialNegativeValue()
    {
       $this->assertExpression(null, '-1!');
    }
}
