<?php

namespace Riimu\Expresso\Library;

use Riimu\Expresso\Context\NamespaceContext;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
abstract class Library
{
    protected static $operators = [];

    public function addToNamespace(NamespaceContext $namespace)
    {
        if (!empty(static::$operators)) {
            $this->addOperators($namespace, static::$operators, get_class($this));
        }
    }

    public function addOperators(NamespaceContext $namespace, array $operators, $class)
    {
        foreach ($operators as $op) {
            list($method, $rpnToken, $infixToken, $type, $associativity,
                $precedence) = $op;

            $callback = [$class, $method];

            $namespace->addOperator($callback, $rpnToken, $infixToken, $type,
                $associativity, $precedence);
        }
    }
}
