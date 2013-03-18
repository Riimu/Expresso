<?php

namespace Riimu\Expresso\Expression;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Call extends Token
{
    private $rpnToken;
    private $callback;
    private $argumentCount;

    public function __construct(callable $callback, $rpnToken, $argumentCount = false)
    {
        $this->callback = $callback;
        $this->rpnToken = $rpnToken;
        $this->argumentCount = $argumentCount;
    }

    public function getArgumentCount()
    {
        return $this->argumentCount;
    }

    public function __invoke(\Riimu\Expresso\Context\ArgumentContext $arguments)
    {
        return call_user_func($this->callback, $arguments);
    }

    public function getRPNToken()
    {
        return $this->rpnToken;
    }
}
