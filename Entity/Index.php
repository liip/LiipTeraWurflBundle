<?php

namespace Liip\TeraWurflBundle\Entity;

class Index
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $matcher;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
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

