<?php

namespace Riimu\Expresso\Context;

use Riimu\Expresso\Library;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class NamespaceContext
{
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

        if ($type === Library\Operator::BINARY) {
            $this->operators['binary'][$infixToken] = $operator;
        }
    }

    public function getBinaryOperator($infixToken)
    {
        $data = $this->operators['binary'][$infixToken];
        return new Library\Operator($data['callback'], $data['rpnToken'],
            $data['infixToken'], $data['type'], $data['associativity'],
            $data['precedence']);
    }

    public function getBinaryOperatorTokens()
    {
        return array_keys($this->operators['binary']);
    }
}
