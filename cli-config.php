<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/autoload/database.local.php';

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Mapping\Driver\XmlDriver;


$driver = new XmlDriver(__DIR__ . '/module/Core/config/xml/entities');

$config = Setup::createconfiguration(false);
$config->setMetadataDriverImpl($driver);

$entityManager = EntityManager::create($cliParams, $config);

return ConsoleRunner::createHelperSet($entityManager);
