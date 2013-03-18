<?php

namespace Riimu\Expresso\Context;

use Riimu\Expresso\Library\ArgumentsException;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class ArgumentContext
{
    private $arguments;

    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }

    public function getReal($n)
    {
        return $this->arguments[$n]->getReal();
    }

    public function throwException($message)
    {
        throw new ArgumentsException($message, $this);
    }
}
