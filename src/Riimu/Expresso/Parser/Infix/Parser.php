<?php

namespace Riimu\Expresso\Parser\Infix;

use Riimu\Expresso\Context\Context;
use Riimu\Expresso\Number\Factory;
use Riimu\Expresso\Expression;
use Riimu\Expresso\Parser\ParsingException;
use Riimu\Expresso\Library\Operator as op;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Parser extends \Riimu\Expresso\Parser\Parser
{
    private $context;
    private $namespace;
    private $factory;
    private $tokenizer;
    private $output;
    private $stack;
    private $valueContext;

    public function __construct(Context $context, Factory $factory)
    {
        $this->context = $context;
        $this->namespace = $context->getNamespace();
        $this->factory = $factory;
        $this->tokenizer = null;
        $this->output = [];
        $this->stack = [];
        $this->valueContext = true;
    }

    public function getTokenizer()
    {
        if ($this->tokenizer === null) {
            $this->tokenizer = new Tokenizer($this->namespace);
        }

        return $this->tokenizer;
    }

    public function parse($string)
    {
        $tokenizer = $this->getTokenizer();
        $tokenizer->setString($string);
        $this->output = [];
        $this->stack = [];
        $this->valueContext = true;

        while ($token = $tokenizer->getNextToken($this->valueContext)) {
            $this->pushToken($token);
        }

        while (!empty($this->stack)) {
            $this->pushFromStack(array_pop($this->stack));
        }

        if ($this->valueContext) {
            throw new ParsingException("Unexpected end", strlen($string), 2);
        }

        return new Expression\Expression($this->output, $this->context);
    }

    private function pushToken(Token $token)
    {
        if ($token->isNumber()) {
            $this->pushNumber($token);
        } elseif ($token->isOperator()) {
            $this->pushOperator($token);
        }
    }

    private function pushNumber(Token $token)
    {
        if ($token->getType() === Token::TYPE_INTEGER) {
            $number = $this->factory->createInteger($token->getString());
        }

        $this->output[] = $number;
        $this->valueContext = false;
    }

    private function pushOperator(Token $token)
    {
        if ($token->getType() === Token::TYPE_BINARY_OPERATOR) {
            $o1 = $this->namespace->getBinaryOperator($token->getString());
        }

        while(($top = end($this->stack)) && $top->isOperator()) {
            $o2 = $top->getOperator();

            if ($o1->getAssociativity() === op::LEFT) {
                if ($o1->getPrecedence() > $o2->getPrecedence()) {
                    break;
                }
            }

            array_pop($this->stack);
            $this->output[] = $o2->getExpressionToken();
        }

        $token->setOperator($o1);
        $this->stack[] = $token;
        $this->valueContext = true;
    }

    private function pushFromStack(Token $token)
    {
        if ($token->isOperator()) {
            $this->output[] = $token->getOperator()->getExpressionToken();
        }
    }
}
