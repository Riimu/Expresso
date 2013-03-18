<?php

namespace Riimu\Expresso\Context;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class Context
{
    private $namespace;

    public function __construct(NamespaceContext $namespace)
    {
        $this->namespace = $namespace;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }
}
