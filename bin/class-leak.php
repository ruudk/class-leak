<?php

declare(strict_types=1);

use TomasVotruba\ClassLeak\DependencyInjection\ContainerFactory;

if (file_exists(__DIR__ . '/../../../../vendor/autoload.php')) {
    // project's autoload
    require_once __DIR__ . '/../../../../vendor/autoload.php';
}

if (file_exists(__DIR__ . '/../vendor/scoper-autoload.php')) {
    // A. build downgraded package
    require_once __DIR__ . '/../vendor/scoper-autoload.php';
} else {
    // B. local repository
    require_once __DIR__ . '/../vendor/autoload.php';
}

$containerFactory = new ContainerFactory();
$container = $containerFactory->create();

/** @var \Symfony\Component\Console\Application $application */
$application = $container->make(\Symfony\Component\Console\Application::class);

$input = new Symfony\Component\Console\Input\ArgvInput();
$output = new Symfony\Component\Console\Output\ConsoleOutput();

$exitCode = $application->run($input, $output);
exit($exitCode);
