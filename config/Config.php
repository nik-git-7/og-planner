<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;


class Config
{
    const EXIT_SUCCESS = 0;
    const EXIT_FAILURE = 1;

    const DB_HOST = '127.0.0.1';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_NAME = 'og-db';
    const DB_DRIVER = 'pdo_mysql';
    
    const BASEDIR = __DIR__ . '/../';

    const PLANNER_URL = 'http://vertretungsplan.gym-oppenheim.de/V_DC_001.html';
    const TEST_PLANNER_URL_1 = self::BASEDIR . 'tests/res/planner_page_1.html';

    const LOG_FILE = '../var/logfile.log';
    const LAST_UPDATE = '../var/last_update';

    public static function getEntityManager(): EntityManager
    {
        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;
        $config = Setup::createAnnotationMetadataConfiguration(array(self::BASEDIR . '/src'), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        $connectionParams = array(
            'dbname' => self::DB_NAME,
            'user' => self::DB_USERNAME,
            'password' => self::DB_PASSWORD,
            'host' => self::DB_HOST,
            'driver' => self::DB_DRIVER
        );

        $conn = null;
        try {
            $conn = DriverManager::getConnection($connectionParams, $config);
        } catch (\Doctrine\DBAL\Exception $e) {
            echo $e->getMessage();
            exit(self::EXIT_FAILURE);
        }

        $entityManager = null;
        try {
            $entityManager = EntityManager::create($conn, $config);
        } catch (ORMException $e) {
            echo $e->getMessage();
            exit(self::EXIT_FAILURE);
        }

        return $entityManager;
    }
}