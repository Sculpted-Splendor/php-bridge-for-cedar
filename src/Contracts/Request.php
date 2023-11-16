<?php
declare(strict_types=1);

namespace SculptedSplendor\PhpBridgeForCedar\Contracts;

interface Request
{
    public function getAction(): string;
    public function getPrincipal(): string;
    public function getResource(): string;
}
