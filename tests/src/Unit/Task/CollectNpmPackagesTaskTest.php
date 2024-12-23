<?php

declare(strict_types = 1);

namespace Pamald\Robo\PamaldNpm\Tests\Unit\Task;

use Pamald\Robo\PamaldNpm\Task\CollectNpmPackagesTask;
use Pamald\Robo\PamaldNpm\Task\TaskBase;
use Pamald\Robo\PamaldNpm\Tests\Helper\DummyTaskBuilder;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass(CollectNpmPackagesTask::class)]
#[CoversClass(TaskBase::class)]
class CollectNpmPackagesTaskTest extends TaskTestBase
{
    /**
     * @return resource
     */
    protected static function createStream()
    {
        $filePath = 'php://memory';
        $resource = fopen($filePath, 'rw');
        if ($resource === false) {
            throw new \RuntimeException("file $filePath could not be opened");
        }

        return $resource;
    }

    /**
     * @return array<string, mixed>
     */
    public static function casesRunSuccess(): array
    {
        return [
            'basic' => [
                'expected' => [
                    'exitCode' => 0,
                    'exitMessage' => '',
                    'assets' => [
                        'pamald.npmPackages' => [
                            'a' => [],
                            'b' => [],
                        ],
                    ],
                ],
                'options' => [
                    'lock' => [
                        'packages' => [
                             'a' => [
                                 'version' => '1.0.0',
                             ],
                             'b' => [
                                 'version' => '2.0.0',
                             ],
                        ],
                    ],
                    'json' => [
                        'dependencies' => [
                            'a' => '^1.0',
                        ],
                        'devDependencies' => [
                            'b' => '^2.0',
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * @phpstan-param array<string, mixed> $expected
     * @phpstan-param robo-pamald-npm-collect-packages-task-options $options
     */
    #[Test]
    #[DataProvider('casesRunSuccess')]
    public function testRunSuccess(array $expected, array $options): void
    {
        $taskBuilder = new DummyTaskBuilder();
        $taskBuilder->setContainer($this->getNewContainer());

        $task = $taskBuilder->taskPamaldCollectNpmPackages($options);
        $result = $task->run();

        static::assertSame($expected['exitCode'], $result->getExitCode());
        static::assertSame($expected['exitMessage'], $result->getMessage());
        static::assertSame(
            array_keys($expected['assets']['pamald.npmPackages']),
            array_keys($result['pamald.npmPackages']),
        );
    }
}
