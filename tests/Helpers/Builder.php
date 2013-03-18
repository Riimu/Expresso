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
    private static $standardNamespace;
    private static $standardTokenizer;

    public static function standardNamespace()
    {
        if (!isset(self::$standardNamespace)) {
            $namespace = new Lib\Context\NamespaceContext();

            $namespace->addLibrary(new Lib\Library\InternalMath\InternalFunctions());
            $namespace->addLibrary(new Lib\Library\InternalMath\InternalOperators());
            $namespace->addLibrary(new Lib\Library\InternalMath\AdditionalOperators());

            self::$standardNamespace = $namespace;
        }

        return clone self::$standardNamespace;
    }

    public static function standardContext()
    {
        $context = new Lib\Context\Context(self::standardNamespace());
        return $context;
    }

    public static function standarTokenizer()
    {
        if (!isset(self::$standardTokenizer)) {
            self::$standardTokenizer =
                new Lib\Parser\Infix\Tokenizer(self::standardNamespace());
        }

        return clone self::$standardTokenizer;
    }

    public static function standardParser()
    {
        $parser = new Lib\Parser\Infix\Parser(self::standardContext(),
            new Lib\Number\Internal\Factory());
        $parser->setTokenizer(self::standarTokenizer());
        return $parser;
    }
}
