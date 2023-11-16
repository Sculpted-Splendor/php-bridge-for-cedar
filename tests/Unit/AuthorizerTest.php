<?php

namespace SculptedSplendor\PhpBridgeForCedar\Tests\Unit;

use SculptedSplendor\PhpBridgeForCedar\Authorizer;
use SculptedSplendor\PhpBridgeForCedar\CedarBridge;
use Mockery;
use SculptedSplendor\PhpBridgeForCedar\Request;
use Symfony\Component\Process\Process;

function makeMockBridge(): Mockery\MockInterface
{
    $instance = Mockery::mock(CedarBridge::class);
    $instance->shouldReceive('bridge')
        ->andReturn(new Process([]))
        ->byDefault();
    return $instance;
}

function makeAuthorizer(mixed $bridge): Authorizer
{
    return new Authorizer($bridge, '', '');
}

test('returns false if unauthorized exit code returned', function () {
    $bridge = makeMockBridge();

    $process = Mockery::mock(Process::class);
    $process->shouldReceive('run')->byDefault();
    $process->shouldReceive('getExitCode')->andReturn(1)->byDefault();

    $bridge->shouldReceive('bridge')->andReturn($process)->byDefault();

    $authorizer = makeAuthorizer($bridge);

    $result = $authorizer->isAuthorized(
        new Request(
            '',
            '',
            ''
        )
    );

    expect($result)->toBeFalse();
});

test('returns true if authorized exit code returned', function () {
    $bridge = makeMockBridge();

    $process = Mockery::mock(Process::class);
    $process->shouldReceive('run')->byDefault();
    $process->shouldReceive('getExitCode')->andReturn(Authorizer::EXIT_CODE_ALLOW)->byDefault();

    $bridge->shouldReceive('bridge')->andReturn($process)->byDefault();

    $authorizer = makeAuthorizer($bridge);

    $result = $authorizer->isAuthorized(
        new Request(
            '',
            '',
            ''
        )
    );

    expect($result)->toBeTrue();
});

test('calls bridge authorize command', function () {
    $bridge = makeMockBridge();

    $authorizer = makeAuthorizer($bridge);

    $authorizer->isAuthorized(
        new Request(
            '',
            '',
            ''
        )
    );

    $bridge->shouldHaveReceived('bridge')->once();
});
