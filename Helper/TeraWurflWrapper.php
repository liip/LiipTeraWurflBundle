<?php

namespace Liip\TeraWurflBundle\Helper;

use Liip\TeraWurflBundle\VendorInterface\TeraWurflSymfony;

/**
 * Wrapper for the TeraWurfl class
 *
 * @author Alain Horner <alain.horner@liip.ch>
 * @author Lea Haensenberger <lea.haensenberger@gmail.com>
 */
class TeraWurflWrapper {

    /**
     * @var TeraWurflSymonfy
     */
    protected $wurfl;

    public function __construct(TeraWurflSymfony $wurfl)
    {
        $this->wurfl = $wurfl;
    }

    public function isMobileDevice($server = null)
    {
        $this->wurfl->getDeviceCapabilitiesFromRequest($server);
        return $this->wurfl->getDeviceCapability("is_wireless_device");
    }
}
