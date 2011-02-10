<?php

namespace Liip\TeraWurflBundle\VendorInterface\;

use Liip\TeraWurflBundle\VendorInterface\DatabaseConnectors\TeraWurflDatabase_Symfony

class TeraWurflSymfony extends \TeraWurfl
{

    /**
     * our bundle config wrapper
     * @var TeraWurflConfig
     */
    protected $config;

    /**
     * database storage for Terafurl to use
     * @var TeraWurflDatabase_Symfony
     */
    protected $db;

    /**
     * constructor. overridden so that we can set $this->db so that the parent class
     * won't try to construct a db for us with no DI
     */
    public function __construct(\TeraWurflConfig $config, TeraWurflDatabase_Symfony $db)
    {
        $this->config = $config;
        $this->db = $db;
        parent::__construct();
    }

}
