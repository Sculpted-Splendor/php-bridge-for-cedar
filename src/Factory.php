<?php
declare(strict_types=1);

namespace SculptedSplendor\PhpBridgeForCedar;

class Factory
{
    public function __construct(
        private readonly Config $config
    ) { }

    public function makeAuthorizer(
        string $policy,
        string $entities,
    ): Authorizer {
        return new Authorizer(
            new CedarBridge($this->config),
            $policy,
            $entities
        );
    }
}
