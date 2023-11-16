<?php

namespace SculptedSplendor\PhpBridgeForCedar\Tests\Unit;

use SculptedSplendor\PhpBridgeForCedar\Request;

function makeRequest(): Request {
    return new Request(
        action: 'Action::"read"',
        principal: 'Group::"admin"',
        resource: 'File::"importantDoc.txt"',
    );
}

test('returns correct action', function () {
    $result = makeRequest();

    expect($result->getAction())->toBe('Action::"read"');
});

test('returns correct principal', function () {
    $result = makeRequest();

    expect($result->getPrincipal())->toBe('Group::"admin"');
});

test('returns correct resource', function () {
    $result = makeRequest();

    expect($result->getResource())->toBe('File::"importantDoc.txt"');
});
