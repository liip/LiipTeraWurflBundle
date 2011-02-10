<?php

namespace Liip\TeraWurflBundle\VendorInterface\DatabaseConnectors;

class TeraWurflDatabase_Symfony extends \TeraWurflDatabase
{
    /**
     * entity manager
     * @var entityManager
     */
    protected $entityManager;

    /**
     * DBAL connection
     * @var DBAL
     */
    protected $conn;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->conn = $this->entityManager->getConnection();
    }

    public function getDeviceFromID($wurflID)
    {
        if (!$rs = $this->conn->fetchAssoc(
            'SELECT * FROM terawurfl_merge WHERE deviceid = :deviceid',
            array('deviceid' => $wurflID);
        )) {
            throw new Exception("Tried to look up an invalid WURFL device: $wurflID");
        }
        return unserialize($data['capabilities']);

    }

    public function getFullDeviceList($tablename)
    {

    }

    public function getDeviceFromUA($useragent)
    {

    }

    public function loadDevices(&$tables)
    {

    }

    public function getDeviceFromCache($userAgent)
    {

    }

    public function saveDeviceInCache($useragent, &$device)
    {

    }

    public function createCacheTable()
    {

    }

    public function rebuildCacheTable()
    {

    }

    public function createSettingsTable()
    {

    }

    public function connect()
    {

    }

    public function updateSetting($key,$value)
    {

    }

    public function getSetting($key)
    {

    }

    public function SQLPrep($raw_text)
    {

    }

    public function getTableList()
    {

    }

    public function getTableStats($table)

    }

    public function getCachedUserAgents()
    {

    }

    //TODO:  override initialize?
    public function getServerVersion()
    {

    }


    // methods enforced by parent class, but never called ----------------------
    public function getMatcherTableList(){return array();}
    public function createGenericDeviceTable($tablename) {}
    public function getActualDeviceAncestor($wurflID) {}
    public function clearTable($tablename) {}
    public function createIndexTable(){}

}
