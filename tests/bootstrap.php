<?php

require __DIR__ . '/../vendor/autoload.php';

$classLoader = new Riimu\Kit\ClassLoader\BasePathLoader();
$classLoader->setLoadFromIncludePath(false);
$classLoader->addNamespacePath('Riimu\Expresso', __DIR__ . '/../src');
$classLoader->addBasePath(__DIR__ . '/helpers');
$classLoader->register();

