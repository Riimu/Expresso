<?php

namespace Riimu\Expresso;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class NamespaceHandler
{
    const OPERATOR_TYPE_BINARY = 1;

    const OPERATOR_ASSOCIATIVITY_LEFT = 1;

    private $operators;

    public function __construct()
    {
        $this->operators = [
            'binary' => [],
        ];
    }

    public function addLibrary(Library\Library $library)
    {
        $library->addToNamespace($this);
        return $this;
    }

    public function addOperator(callable $callback, $rpnToken, $infixToken,
        $type, $associativity, $precedence)
    {
        $operator = [
            'callback' => $callback,
            'rpnToken' => $rpnToken,
            'infixToken' => $infixToken,
            'type' => $type,
            'associativity' => $associativity,
            'precedence' => $precedence,
        ];

        if ($type === self::OPERATOR_TYPE_BINARY) {
            $this->operators['binary'][$symbol] = $operator;
        }
    }
}
