<?php
declare(strict_types=1);

namespace SculptedSplendor\PhpBridgeForCedar;

use SculptedSplendor\PhpBridgeForCedar\Contracts\Config as ConfigContract;

class Config implements ConfigContract
{
    public function __construct(
        private readonly string $cedarInstallationPath,
    ) { }

    public function getInstallationPath(): string
    {
        return $this->cedarInstallationPath;
    }
}
