<?php

namespace Riimu\Expresso\Parser\Infix;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Token
{
    const TYPE_INTEGER = 1;
    const TYPE_BINARY_OPERATOR = 2;

    private static $numberTypes = [
        self::TYPE_INTEGER
    ];

    private static $operatorTypes = [
        self::TYPE_BINARY_OPERATOR
    ];

    private $type;
    private $string;
    private $operator;

    public function __construct($type, $string)
    {
        $this->type = $type;
        $this->string = $string;
        $this->operator = null;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getString()
    {
        return $this->string;
    }

    public function isNumber()
    {
        return in_array($this->type, self::$numberTypes);
    }

    public function isOperator()
    {
        return in_array($this->type, self::$operatorTypes);
    }

    public function setOperator(\Riimu\Expresso\Library\Operator $operator)
    {
        $this->operator = $operator;
    }

    public function getOperator()
    {
        return $this->operator;
    }
}
