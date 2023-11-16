<?php
declare(strict_types=1);

namespace SculptedSplendor\PhpBridgeForCedar;

use SculptedSplendor\PhpBridgeForCedar\Contracts\Request;

class Authorizer
{
    public const EXIT_CODE_ALLOW = 0;

    public function __construct(
        private readonly CedarBridge $bridge,
        private readonly string $policy,
        private readonly string $entities,
    ) { }

    /**
     * @param Request $request
     * @return bool
     * @throws Exception\CannotExecuteCedarException
     */
    public function isAuthorized(
        Request $request,
    ): bool {
        $result = $this->bridge->bridge([
            'authorize',
            '--policies', $this->policy,
            '--entities', $this->entities,
            '--principal', $request->getPrincipal(),
            '--resource', $request->getResource(),
            '--action', $request->getAction(),
            '--error-format', 'json',
        ]);

        return $result->getExitCode() === self::EXIT_CODE_ALLOW;
    }
}
