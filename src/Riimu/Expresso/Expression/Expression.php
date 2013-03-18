<?php

namespace Riimu\Expresso\Expression;

use Riimu\Expresso\Context;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Expression extends Value
{
    private $input;
    private $context;

    public function __construct(array $input, Context\Context $context)
    {
        $this->input = $input;
        $this->context = $context;
    }

    public function evaluate()
    {
        $stack = [];

        foreach ($this->input as $token) {
            if ($token instanceof Value) {
                $stack[] = $token;
            } elseif ($token instanceof Call) {
                $stack[] = $this->evaluateCall($token, $stack);
            }
        }

        if (count($stack) !== 1) {
            throw new \RuntimeException("Expected 1 value in stack at the " .
                "end of evaluation, got '" . count($stack) . "'");
        }

        return end($stack);
    }

    private function evaluateCall(Call $token, array & $stack)
    {
        $args = [];

        if (($count = $token->getArgumentCount()) !== false) {
            if (count($stack) < $count) {
                throw new \UnderflowException("Expected at least " .
                    "$count values in stack, got '" . count($stack) . '"');
            }

            while ($count--) {
                $args[] = array_pop($stack);
            }
        }

        $result = $token(new Context\ArgumentContext(array_reverse($args), $this->context));

        if (!($result instanceof Value)) {
            $name = is_object($result) ? get_class($result) : gettype($result);
            throw new \UnexpectedValueException("Call return value " .
                "must be instance of Expression\Value, got '$name'");
        }

        return $result;
    }

    public function getReal()
    {
        return $this->evaluate()->getReal();
    }

    public function getPrimitive()
    {
        return $this->evaluate()->getPrimitive();
    }

    public function getRPNToken()
    {
        $tokens = [];
        foreach ($this->input as $token) {
            $tokens[] = $token->getRPNToken();
        }
        return implode(' ', $tokens);
    }
}
