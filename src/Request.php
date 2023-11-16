<?php
declare(strict_types=1);

namespace SculptedSplendor\PhpBridgeForCedar;

use SculptedSplendor\PhpBridgeForCedar\Contracts\Request as RequestContract;

class Request implements RequestContract
{
    public function __construct(
        private readonly string $action,
        private readonly string $principal,
        private readonly string $resource,
    ) { }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getPrincipal(): string
    {
        return $this->principal;
    }

    public function getResource(): string
    {
        return $this->resource;
    }
}
