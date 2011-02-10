<?php

/*
 * This file is part of the Liip/TeraWurflBundle
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liip\TeraWurflBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LiipTeraWurflBundle extends Bundle
{
    public function getNamespace()
    {
        return __NAMESPACE__;
    }

    public function getPath()
    {
        return __DIR__;
    }
}
