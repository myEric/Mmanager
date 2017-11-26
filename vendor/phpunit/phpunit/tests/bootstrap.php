<?php
<<<<<<< HEAD
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Framework/Assert/Functions.php';
require __DIR__ . '/_files/CoveredFunction.php';
require __DIR__ . '/autoload.php';

if (!ini_get('date.timezone') && !defined('HHVM_VERSION')) {
  echo PHP_EOL . 'Error: PHPUnit\'s test suite requires the "date.timezone" runtime configuration to be set. Please check your php.ini.' . PHP_EOL;
  exit(1);
}
=======
// Needed for isolated tests
require __DIR__.'/../vendor/autoload.php';
>>>>>>> ea79a2f50edc89e12eeb879d17155d120f28d68e

ini_set('precision', 14);
ini_set('serialize_precision', 14);
