<?php

use Helpers\Builder as Build;
use Riimu\Expresso as Lib;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class ErrorCaseTest extends PHPUnit_Framework_TestCase
{
    public function testUnexpectedCharacter()
    {
        $parser = Build::standardParser();

        try {
            $parser->parse('1 `+ 1');
        } catch (Lib\Parser\ParsingException $ex) {
            $this->assertEquals(1, $ex->getCode());
            $this->assertEquals(2, $ex->getPosition());

            return;
        }

        $this->fail();
    }

    /**
     * @expectedException \Riimu\Expresso\Parser\ParsingException
     * @expectedExceptionCode 2
     */
    public function testUnexpectedEnd()
    {
        $parser = Build::standardParser();
        $parser->parse('1 + ');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidInternalNumberValue()
    {
        new Lib\Number\Internal\Number('1');
    }
}
