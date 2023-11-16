<?php

namespace SculptedSplendor\PhpBridgeForCedar\Tests\Unit;

use SculptedSplendor\PhpBridgeForCedar\Config;

function makeConfig(string $installPath): Config {
    return new Config($installPath);
}

test("returns correct path", function () {
    $result = makeConfig('/test/path/to/cedar');

    expect($result->getInstallationPath())->toEqual('/test/path/to/cedar');
});

