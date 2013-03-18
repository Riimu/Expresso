<?php

namespace Helpers;

use Helpers\Builder as Build;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
trait ExpressionTester
{
    private static $parser;

    private function getParser()
    {
        if (!isset(self::$parser)) {
            self::$parser = Build::standardParser();
        }

        return self::$parser;
    }

    protected function assertExpression($expected, $expression, $debug = false)
    {
        $expression = $this->getParser()->parse($expression);

        if ($debug) {
            var_dump($expression);
        }

        $this->assertEquals($expected, $expression->getPrimitive());

    }

    protected function assertRPNEquals($expected, $expression)
    {
        $result = (string) $this->getParser()->parse($expression);
        $this->assertEquals($expected, $result);
    }
}
