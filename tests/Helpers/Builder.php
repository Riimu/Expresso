<?php

namespace Helpers;

use Riimu\Expresso as Lib;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Builder
{
    private static $standardContext;

    public static function standardContext()
    {
        if (!isset(self::$standardContext)) {
            $namespace = new Lib\Context\NamespaceContext();
            $namespace->addLibrary(new Lib\Library\InternalMath\InternalFunctions());
            $namespace->addLibrary(new Lib\Library\InternalMath\InternalOperators());
            self::$standardContext = new Lib\Context\Context($namespace);
        }

        return clone self::$standardContext;
    }
}
