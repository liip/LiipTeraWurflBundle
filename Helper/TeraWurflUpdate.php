<?php

namespace Liip\TeraWurflBundle\Helper;

use Liip\TeraWurflBundle\VendorInterface\TeraWurflSymfony;

/**
 * Updates the teraWurfl database
 *
 * @author Alain Horner <alain.horner@liip.ch>
 * @author Lea Haensenberger <lea.haensenberger@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
class TeraWurflUpdate {

    /**
     * @var TeraWurflSymonfy
     */
    protected $wurfl;

    public function __construct($first, TeraWurflSymfony $wurfl)
    {
        $this->wurfl = $wurfl;
    }

    public function updateFrom($src)
    {
        //
    }

}
