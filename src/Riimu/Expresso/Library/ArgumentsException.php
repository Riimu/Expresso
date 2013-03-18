<?php

namespace Riimu\Expresso\Library;

use Riimu\Expresso\Context\ArgumentContext;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class ArgumentsException extends \InvalidArgumentException
    implements \Riimu\Expresso\Exception
{
    private $argumentContext;

    public function __construct($message, ArgumentContext $context)
    {
        parent::__construct($message);
        $this->argumentContext = $context;
    }
}
