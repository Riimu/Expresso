<?php

namespace Test\Parser\Infix;

use Helpers\Builder as Build;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class ParserTest extends \PHPUnit_Framework_TestCase
{
    public function testGetTokenizer()
    {
        $namespace = new \Riimu\Expresso\Context\NamespaceContext();
        $context = new \Riimu\Expresso\Context\Context($namespace);
        $factory = new \Riimu\Expresso\Number\Internal\Factory();

        $parser = new \Riimu\Expresso\Parser\Infix\Parser($context, $factory);
        $this->assertInstanceOf('\Riimu\Expresso\Parser\Infix\Tokenizer', $parser->getTokenizer());
    }
}
