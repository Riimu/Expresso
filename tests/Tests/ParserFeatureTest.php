<?php

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class ParserFeatureTest extends PHPUnit_Framework_TestCase
{
    use \Helpers\ExpressionTester;

    public function testIntegerParsing()
    {
        $this->assertExpression(136, '37 + 99');
        $this->assertExpression(62, '-37 + 99');
        $this->assertExpression(-62, '37 + -99');
        $this->assertExpression(-136, '-37 + -99');
    }

    public function testMultipleTerms()
    {
        $this->assertExpression(6, '3 + 2 + 1');
    }

    public function testOperatorPrecedence()
    {
        $this->assertExpression(10, '4 + 2 * 3');
    }

    public function testWhiteSpace()
    {
        $this->assertExpression(10, '4+2*3');
    }

    public function testRightAssociativity()
    {
        $this->assertExpression(65536, '4 ^ 2 ^ 3');
        $this->assertExpression(21, '2 + 4 ^ 2 + 3');
    }

    public function testPreOperators()
    {
        $this->assertExpression(-42, '-42');
        $this->assertExpression(42, '- -42');
    }

    public function testPostOperators()
    {
        $this->assertExpression(24, "4!");
    }
}
