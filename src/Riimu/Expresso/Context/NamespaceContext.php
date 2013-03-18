<?php

namespace Riimu\Expresso\Context;

use Riimu\Expresso\Library\Library;
use Riimu\Expresso\Library\Operator as Op;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class NamespaceContext
{
    const BINARY_OPERATOR = 1;
    const PRE_OPERATOR = 2;
    const POST_OPERATOR = 3;

    private $operators;
    private $rpnTokens;

    public function __construct()
    {
        $this->rpnTokens = [];
        $this->operators = [
            'binary' => [],
            'unary-right' => [],
            'unary-left' => [],
        ];
    }

    public function addLibrary(Library $library)
    {
        $library->addToNamespace($this);
        return $this;
    }

    private function addRPNToken(callable $callback, $rpnToken, $argumentCount)
    {
        if (isset($this->rpnTokens[$rpnToken])) {
            throw new \InvalidArgumentException("The RPN token '$rpnToken' already exists");
        }

        $this->rpnTokens[$rpnToken] = [
            'rpnToken' => $rpnToken,
            'callback' => $callback,
            'argumentCount' => $argumentCount,
        ];
    }

    public function addOperator(callable $callback, $rpnToken, $infixToken,
        $type, $associativity, $precedence)
    {
        $this->addRPNToken($callback, $rpnToken, $type === Op::BINARY ? 2 : 1);

        $operator = [
            'callback' => $callback,
            'rpnToken' => $rpnToken,
            'infixToken' => $infixToken,
            'type' => $type,
            'associativity' => $associativity,
            'precedence' => $precedence,
        ];

        if ($type === Op::BINARY) {
            $list =& $this->operators['binary'];
            $duplicate =& $this->operators['unary-left'];
        } elseif ($type === Op::UNARY) {
            if ($associativity === Op::RIGHT) {
                $list =& $this->operators['unary-right'];
                $duplicate =& $list;
            } elseif ($associativity === Op::LEFT) {
                $list =& $this->operators['unary-left'];
                $duplicate =& $this->operators['binary'];
            }
        }

        if (isset($list[$infixToken]) || isset($duplicate[$infixToken])) {
            throw new \InvalidArgumentException("Conflicting operator '$infixToken' already exists");
        }

        $list[$infixToken] = $operator;
    }

    public function getOperator($infixToken, $type)
    {
        if ($type === self::BINARY_OPERATOR) {
            $data = $this->operators['binary'][$infixToken];
        } elseif ($type === self::PRE_OPERATOR) {
            $data = $this->operators['unary-right'][$infixToken];
        } elseif ($type === self::POST_OPERATOR) {
            $data = $this->operators['unary-left'][$infixToken];
        }

        return new Op($data['callback'], $data['rpnToken'],
            $data['infixToken'], $data['type'], $data['associativity'],
            $data['precedence']);
    }

    public function getOperatorTokens($type) {
        if ($type === self::PRE_OPERATOR) {
            return array_keys($this->operators['unary-right']);
        } elseif ($type === self::POST_OPERATOR) {
            return array_keys($this->operators['unary-left']);
        } else {
            return array_keys($this->operators['binary']);
        }
    }
}
