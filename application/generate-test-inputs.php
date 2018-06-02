#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use src\Command\GenerateTestInputsCommand;

$application = new Application();
$application->add(new GenerateTestInputsCommand());

$application->run();