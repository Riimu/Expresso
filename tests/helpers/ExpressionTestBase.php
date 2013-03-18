<?php

use Riimu\Expresso as Lib;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class ExpressionTestBase extends PHPUnit_Framework_TestCase
{
    protected static $parser;

    public static function setUpBeforeClass()
    {
        $namespace = new Lib\Context\NamespaceContext();
        $factory = new Lib\Number\Internal\Factory();

        $namespace->addLibrary(new Lib\Library\InternalMath\InternalFunctions());
        $namespace->addLibrary(new Lib\Library\InternalMath\InternalOperators());

        $context = new Lib\Context\Context($namespace);

        self::$parser = new Lib\Parser\Infix\Parser($context, $factory);
    }

    protected function assertExpression($expected, $expression)
    {
        $result = self::$parser->parse($expression)->getPrimitive();
        $this->assertEquals($expected, $result);
    }
}
