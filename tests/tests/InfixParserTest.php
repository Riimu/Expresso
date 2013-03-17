<?php

use Riimu\Expresso as Lib;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class InfixParserTest extends PHPUnit_Framework_TestCase
{
    private static $parser;

    public static function setUpBeforeClass()
    {
        $namespace = new Lib\NamespaceHandler();
        $factory = new Lib\Number\Internal\Factory();

        $namespace->addLibrary(new Lib\Library\InternalMath\InternalFunctions());

        self::$parser = new Lib\Parser\Infix\Parser($namespace, $factory);
    }

    public function testAddition()
    {
        $this->assertTrue(true);
    }
}
