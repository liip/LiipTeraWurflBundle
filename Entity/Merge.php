<?php

namespace Liip\TeraWurflBundle\Entity;

class Merge
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var string
     */
    protected $fallBack;

    /**
     * @var boolean
     */
    protected $actualDeviceRoot;

    /**
     * @var boolean
     */
    protected $match;

    /**
     * @var string
     */
    protected $capabilities;

    /**
     * @var string
     */
    protected $matcher;

    
    public function getId()
    {
        return $this->id;
    }

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
    public function getFallBack()
    {
        return $this->fallBack;
    }

    /**
     * @param string $fallBack
     */
    public function setFallBack($fallBack)
    {
        $this->fallBack = $fallBack;
    }

    /**
     * @return Boolean
     */
    public function getActualDeviceRoot()
    {
        return $this->actualDeviceRoot;
    }

    /**
     * @param Boolean $actualDeviceRoot
     */
    public function setActualDeviceRoot($actualDeviceRoot)
    {
        $this->actualDeviceRoot = $actualDeviceRoot;
    }

    /**
     * @return Boolean
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param Boolean $match
     */
    public function setMatch($match)
    {
        $this->match = $match;
    }

    /**
     * @return string
     */
    public function getCapabilities()
    {
        return $this->capabilities;
    }

    /**
     * @param string $capabilities
     */
    public function setCapabilities($capabilities)
    {
        $this->capabilities = $capabilities;
    }

    /**
     * @return string
     */
    public function getMatcher()
    {
        return $this->matcher;
    }

    /**
     * @param string $matcher
     */
    public function setMatcher($matcher)
    {
        $this->matcher = $matcher;
    }
}

