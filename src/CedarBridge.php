<?php
declare(strict_types=1);

namespace SculptedSplendor\PhpBridgeForCedar;

use SculptedSplendor\PhpBridgeForCedar\Exception\CannotExecuteCedarException;
use Symfony\Component\Process\Process;
use SculptedSplendor\PhpBridgeForCedar\Contracts\Config;

class CedarBridge
{
    public const ALLOWED_EXIT_CODES = [0, 2];

    public function __construct(
        private readonly Config $config,
    ) { }

    /**
     * @param array $arguments
     * @return Process
     * @throws CannotExecuteCedarException
     */
    public function bridge(array $arguments): Process
    {
        $process = new Process([$this->config->getInstallationPath(), ...$arguments]);
        $process->run();

        $this->unexpectedOutputGuard($process->getOutput());

        $exitCode = $process->getExitCode();

        if (!in_array($exitCode, self::ALLOWED_EXIT_CODES)) {
            throw new CannotExecuteCedarException($process->getErrorOutput());
        }

        return $process;
    }

    /**
     * @param string $output
     * @return void
     * @throws CannotExecuteCedarException
     */
    private function unexpectedOutputGuard(string $output): void
    {
        $trimmedOutput = trim($output);

        if ($trimmedOutput !== "ALLOW" && $trimmedOutput !== "DENY") {
            throw new CannotExecuteCedarException($output);
        }
    }
}
