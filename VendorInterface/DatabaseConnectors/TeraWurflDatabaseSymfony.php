<?php

namespace Liip\TeraWurflBundle\VendorInterface\DatabaseConnectors;

class TeraWurflDatabaseSymfony extends \TeraWurflDatabase
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

    /**
     * Terawurfl main class
     * @var TeraWurfl
     */
    protected $wurfl;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->conn = $this->entityManager->getConnection();
    }

    public function setWurfl($wurfl)
    {
        $this->wurfl = $wurfl;
    }

    public function getDeviceFromID($wurflID)
    {
        if (!$rs = $this->conn->fetchAssoc(
            'SELECT * FROM terawurfl_merge WHERE deviceid = :deviceid',
            array('deviceid' => $wurflID)
        )) {
            throw new Exception("Tried to look up an invalid WURFL device: $wurflID");
        }
        return unserialize($data['capabilities']);

    }

    public function getFullDeviceList($tablename)
    {
        $matcher = $this->getMatcher($tablename);
        return $this->conn->fetchAll(
            'SELECT id, user_agent FROM terawurfl_merge WHERE match = :match AND matcher = :matcher',
            array('match' => 1, 'matcher' => $matcher)
        );
    }

    public function getDeviceFromUA($useragent)
    {
        return $this->conn->fetchColumn(
            'SELECT id FROM terawurfl_merge WHERE user_agent = :ua',
            array('ua' => $useragent)
        );

    }

    public function loadDevices(&$tables)
    {
        $this->conn->beginTransaction();
        try {
            $this->conn->delete('terawurfl_merge');
            $stmt = $this->conn->prepare(
                'INSERT INTO terawurfl_merge (
                    id, user_agent, fall_back, actual_device_root, match, capabilities, matcher
                )'
            );
            foreach ($tables as $table => $devices) {
                $matcher = $this->getMatcher($table);
                foreach ($devices as $device) {
                    $this->conn->insert(
                        'terawurfl_index', array(
                            'id'      => $device['id'],
                            'matcher' => $matcher
                        )
                    );
                    if(strlen($device['user_agent']) > 255){
                        $errors[] = "Warning: user agent too long: '{$device['id']}'";
                    }
                    $device['match'] = $matcher;
                    $device['capabilities'] = serialize($device['capabilities']);
                    $stmt->execute($device);

                }
            }
            $this->conn->commit();
        } catch (Exception $e) {
            $this->conn->rollback();
            throw $e;
        }
    }

    public function getDeviceFromCache($userAgent)
    {
        if (!$c = $this->conn->fetchColumn(
            'SELECT cache_data FROM terawurfl_cache WHERE user_agent = :ua',
            array('ua' => $userAgent)
        )) {
            return false;
        }
        return unserialize($c);
    }

    public function saveDeviceInCache($useragent, &$device)
    {
        if (strlen($userAgent) == 0) {
            return true;
        }
        return $this->conn->insert(
            'terawurfl_cache',
            array(
                'user_agent' => $userAgent,
                'cache_data' => serialize($device)
            )
        );
    }

    public function rebuildCacheTable()
    {
        $this->conn->beginTransaction();
        try {
            $uas = $this->conn->fetchAll('SELECT user_agent FROM terawurfl_cache');
            $this->conn->delete('terawurfl_cache');
            foreach ($uas as $$ua) {
                $this->wurfl->getDeviceCapabilitiesFromAgent($ua['user_agent']);
            }
        } catch (Exception $e) {
            $this->conn->rollbackTransaction();
            throw $e;
        }
        $this->conn->commit();
    }

    public function updateSetting($key,$value)
    {
        if ($this->conn->fetchColumn('SELECT id FROM terawurfl_settings where id = :id', array($key))) {
            return $this->conn->update(
                'terawurfl_settings',
                array('value' => $value),
                array('id' => $key)
            );
        }
        return $this->conn->insert('terawurfl_settings', array('id' => $key, 'value' => $value));
    }

    public function getSetting($key)
    {
        return $this->conn->fetchColumn('SELECT value FROM terawurfl_settings WHERE id = :id', array('id' => $key));
    }


    public function getCachedUserAgents()
    {
        if (!$uas = $this->conn->fetchAll('SELECT user_agent FROM terawurfl_cache ORDER BY user_agent')) {
            return array();
        }
        $callback = function($a) {
            return $a['user_agent'];
        };
        return array_walk($uas, $callback);
    }

    public function getServerVersion()
    {
        return 'Symfony2 Doctrine Magic Database Pixies!';
    }

    /**
     * Given a namespaced tablename,
     * extract the "matcher" part and return it
     *
     * @param string $tablename
     * @return string
     */
    private function getMatcher($tablename)
    {
        $parts = explode('_', $tablename);
        return array_pop($parts);
    }

    // methods enforced by parent class, but never called ----------------------
    public function getMatcherTableList(){return array();}
    public function getActualDeviceAncestor($wurflID) {}
    public function clearTable($tablename) {}
    public function SQLPrep($raw_text) { }
    public function connect() { }
    public function getTableList() { }
    public function getTableStats($table) { }

    // methods that don't have to do anything since doctrine will create them for us
    public function createIndexTable(){}
    public function createGenericDeviceTable($tablename) {}
    public function createCacheTable() { }
    public function createSettingsTable() { }


}
