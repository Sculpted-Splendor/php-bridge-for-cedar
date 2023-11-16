<?php

require __DIR__ . '/../vendor/autoload.php';

use SculptedSplendor\PhpBridgeForCedar\Factory;
use SculptedSplendor\PhpBridgeForCedar\Config;
use SculptedSplendor\PhpBridgeForCedar\Request;

function fixture(): void {
    $factory = new Factory(new Config(getenv('CEDAR_PATH')));

    $authorizer = $factory->makeAuthorizer(
        __DIR__ . '/policy.cedar',
        __DIR__ . '/entities.json'
    );

    $authorizer->isAuthorized(
        new Request(
            'Action::"read"',
            'User::"123"',
            'File::"/foo/bar"'
        ),
    );
}
