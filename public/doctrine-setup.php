<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Tools\Setup;

require_once 'config.php';


function getEntityManager(): EntityManager
{
// Todo: Check config
    $isDevMode = true;
    $proxyDir = null;
    $cache = null;
    $useSimpleAnnotationReader = false;
    $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . '/src'), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

    $connectionParams = array(
        'dbname' => DB_NAME,
        'user' => DB_USERNAME,
        'password' => DB_PASSWORD,
        'host' => DB_HOST,
        'driver' => DB_DRIVER
    );

    $conn = null;
    try {
        $conn = DriverManager::getConnection($connectionParams, $config);
    } catch (\Doctrine\DBAL\Exception $e) {
        echo $e->getMessage();
        exit(EXIT_FAILURE);
    }

    $entityManager = null;
    try {
        $entityManager = EntityManager::create($conn, $config);
    } catch (ORMException $e) {
        echo $e->getMessage();
        exit(EXIT_FAILURE);
    }

    return $entityManager;
}