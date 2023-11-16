<?php
declare(strict_types=1);

namespace SculptedSplendor\PhpBridgeForCedar\Contracts;

interface Config
{
    public function getInstallationPath(): string;
}
