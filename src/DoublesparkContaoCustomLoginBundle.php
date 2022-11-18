<?php

namespace Doublespark\ContaoCustomLoginBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class DoublesparkContaoCustomLoginBundle
 *
 * @package Doublespark\ContaoCustomLoginBundle
 */
class DoublesparkContaoCustomLoginBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}