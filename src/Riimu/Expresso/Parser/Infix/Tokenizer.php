<?php

namespace Riimu\Expresso\Parser\Infix;

use Riimu\Expresso\Context\NamespaceContext as NS;
use Riimu\Expresso\Parser\ParsingException;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Tokenizer
{
    private $string;
    private $position;
    private $valuePatterns;
    private $operatorPatterns;

    const WHITESPACE_PATTERN = '/\G\s+/';
    const INTEGER_PATTERN = '/\G[+-]?\d+/';

    public function __construct(NS $namespace)
    {
        $this->string = '';
        $this->position = 0;

        $binaryOperators = $this->createOperatorPattern($namespace->getOperatorTokens(NS::BINARY_OPERATOR));
        $preOperators = $this->createOperatorPattern($namespace->getOperatorTokens(NS::PRE_OPERATOR));
        $postOperators = $this->createOperatorPattern($namespace->getOperatorTokens(NS::POST_OPERATOR));

        $this->valuePatterns = [
            [Token::TYPE_INTEGER, self::INTEGER_PATTERN],
            [Token::TYPE_UNARY_PRE_OPERATOR, $preOperators],
        ];
        $this->operatorPatterns = [
            [Token::TYPE_UNARY_POST_OPERATOR, $postOperators],
            [Token::TYPE_BINARY_OPERATOR, $binaryOperators],
        ];
    }

    private function createOperatorPattern(array $symbols)
    {
        usort($symbols, function ($a, $b) {
            return strlen($b) - strlen($a);
        });

		foreach ($symbols as $key => $value) {
			$symbols[$key] = preg_quote($value, '/');
		}

		return '/\G(' . implode('|', $symbols) . ')/i';
	}

    public function setString($string)
    {
        $this->string = $string;
        $this->position = 0;
    }

    public function getNextToken($valueContext)
    {
        $this->parseString(self::WHITESPACE_PATTERN);

        if ($this->position === strlen($this->string)) {
            return false;
        }

        $patterns = $valueContext
            ? $this->valuePatterns : $this->operatorPatterns;

        foreach ($patterns as $data) {
            list($type, $pattern) = $data;
            $string = $this->parseString($pattern);

            if ($string !== false) {
                return new Token($type, $string);
            }
        }

        throw new ParsingException("Unexpected character '" .
            $this->string[$this->position] . "'", $this->position, 1);
    }

    private function parseString($pattern)
    {
        if (preg_match($pattern, $this->string, $matches, 0, $this->position)) {
            $this->position += strlen($matches[0]);
            return $matches[0];
        }

        return false;
    }
}
