<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Create an Application instance
$app = new \Mniik\PhpRaceGame\Commands\RaceGameCommand();
$app->handle();

