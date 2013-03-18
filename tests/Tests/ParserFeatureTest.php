<?php

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class ParserFeatureTest extends ExpressionTestBase
{
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
}
