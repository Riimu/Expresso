<?php

namespace Riimu\Expresso\Library;

use Riimu\Expresso\Expression\Call as ExpressionCall;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Operator
{
    const UNARY = 1;
    const BINARY = 2;

    const LEFT = 10;
    const RIGHT = 11;

    const PREC_SUM_DIFFERENCE = 100;
    const PREC_PRODUCT_QUOTIENT = 101;
    const PREC_POWER = 102;
    const PREC_FACTORIAL = 103;
    const PREC_MINUS_PLUS = 104;

    private $callback;
    private $rpnToken;
    private $infixToken;
    private $type;
    private $associativity;
    private $precedence;

    public function __construct(callable $callback, $rpnToken, $infixToken, $type, $associativity, $precedence)
    {
        $this->callback = $callback;
        $this->rpnToken = $rpnToken;
        $this->infixToken = $infixToken;
        $this->type = $type;
        $this->associativity = $associativity;
        $this->precedence = $precedence;
    }

    public function getAssociativity()
    {
        return $this->associativity;
    }

    public function getPrecedence()
    {
        return $this->precedence;
    }

    public function getExpressionToken()
    {
        $count = $this->type === self::BINARY ? 2 : 1;
        return new ExpressionCall($this->callback, $this->rpnToken, $count);
    }
}
