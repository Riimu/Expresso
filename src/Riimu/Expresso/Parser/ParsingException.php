<?php

namespace Riimu\Expresso\Parser;

/**
 * @author Riikka Kalliomäki <riikka.kalliomaki@gmail.com>
 * @copyright Copyright (c) 2013, Riikka Kalliomäki
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */
class ParsingException extends \InvalidArgumentException implements \Riimu\Expresso\Exception
{
    private $position;

    public function __construct($message, $position, $code)
    {
        parent::__construct($message, $code);

        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }
}
