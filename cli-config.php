<?php
session_start();

require_once('vendor/autoload.php');

$em = \Zeus\Database::getEntityManager();

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($em);