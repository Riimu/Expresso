<?php

namespace Riimu\Expresso\Parser\Infix;

use Riimu\Expresso\NamespaceHandler;
use Riimu\Expresso\Number\Factory;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Parser extends \Riimu\Expresso\Parser\Parser
{
    private $namespace;
    private $factory;

    public function __construct(NamespaceHandler $namespace, Factory $factory)
    {
        $this->namespace = $namespace;
        $this->factory = $factory;
    }

    public function parse($string)
    {
        
    }
}
