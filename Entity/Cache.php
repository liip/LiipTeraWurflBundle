<?php

namespace Liip\TeraWurflBundle\Entity;

class Cache
{
    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var string
     */
    protected $cacheData;

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @return string
     */
    public function getCacheData()
    {
        return $this->cacheData;
    }

    /**
     * @param string $userAgent
     */
    public function setCacheData($cacheData)
    {
        $this->cacheData = $cacheData;
    }
}

