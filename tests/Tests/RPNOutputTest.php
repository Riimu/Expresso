<?php

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class RPNOutputTest extends PHPUnit_Framework_TestCase
{
    use \Helpers\ExpressionTester;
    
    public function testBinaryOperatorOutput()
    {
        $this->assertRPNEquals('1 1 +', '1 + 1');
    }

    public function testOperatorPrecedenceOutput()
    {
        $this->assertRPNEquals('4 2 3 * +', '4 + 2 * 3');
    }
}
