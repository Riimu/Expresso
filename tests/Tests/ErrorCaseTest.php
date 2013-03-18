<?php

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
        $parser = $this->getStandardParser();

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
        $parser = $this->getStandardParser();
        $parser->parse('1 + ');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidInternalNumberValue()
    {
        new Lib\Number\Internal\Number('1');
    }

    private function getStandardParser()
    {
        $factory = new Lib\Number\Internal\Factory();
        $context = $this->getStandardContext();
        return new Lib\Parser\Infix\Parser($context, $factory);
    }

    private function getStandardContext()
    {
        $namespace = new Lib\Context\NamespaceContext();
        $namespace->addLibrary(new Lib\Library\InternalMath\InternalFunctions());
        $namespace->addLibrary(new Lib\Library\InternalMath\InternalOperators());
        return new Lib\Context\Context($namespace);
    }
}
