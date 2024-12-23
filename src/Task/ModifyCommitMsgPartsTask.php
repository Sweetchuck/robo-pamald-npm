<?php

declare(strict_types = 1);

namespace Pamald\Robo\PamaldNpm\Task;

use Pamald\Pamald\PackageCollectorInterface;
use Pamald\PamaldNpm\PackageCollector;
use Pamald\Robo\Pamald\Task\ModifyCommitMsgPartsTaskBase;

class ModifyCommitMsgPartsTask extends ModifyCommitMsgPartsTaskBase
{
    protected string $taskName = 'pamald - NPM - Modify commit message parts';

    protected string $packageManagerName = 'npm';

    /**
     * {@inheritdoc}
     */
    protected array $patterns = [
        // Standard name in the project root or in any sub-directory.
        'package-lock.json',
        '**/package-lock.json',
    ];

    protected function getJsonFilePath(string $lockFilePath): string
    {
        return preg_replace('@-lock\.json$@', '.json', $lockFilePath);
    }

    protected function getPackageCollector(): PackageCollectorInterface
    {
        return new PackageCollector();
    }

    protected function isDomesticated(string $lockFilePath): bool
    {
        return str_starts_with(
            pathinfo($lockFilePath, \PATHINFO_BASENAME),
            'package-',
        );
    }
}
