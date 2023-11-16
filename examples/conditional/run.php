<?php

require __DIR__ . '/../../vendor/autoload.php';

use SculptedSplendor\PhpBridgeForCedar\Factory;
use SculptedSplendor\PhpBridgeForCedar\Config;
use SculptedSplendor\PhpBridgeForCedar\Request;

$factory = new Factory(new Config(getenv('CEDAR_PATH')));

$authorizer = $factory->makeAuthorizer(
    __DIR__ . '/policy.cedar',
    __DIR__ . '/entities.json'
);

$authorized = $authorizer->isAuthorized(
    new Request(
        'Action::"delete"',
        'User::"123"',
        'File::"/foo/bar"'
    ),
);

echo ($authorized) ? 'Authorized' : 'Not Authorized';

echo PHP_EOL;
