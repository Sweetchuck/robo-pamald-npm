<?php

declare(strict_types = 1);

namespace Pamald\Robo\PamaldNpm\Tests\Helper;

use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use Pamald\Robo\PamaldNpm\PamaldNpmTaskLoader;
use Robo\Collection\CollectionBuilder;
use Robo\Common\TaskIO;
use Robo\Contract\BuilderAwareInterface;
use Robo\State\StateAwareTrait;
use Robo\TaskAccessor;

class DummyTaskBuilder implements BuilderAwareInterface, ContainerAwareInterface
{
    use TaskAccessor;
    use ContainerAwareTrait;
    use StateAwareTrait;
    use TaskIO;
    use PamaldNpmTaskLoader {
        taskPamaldCollectNpmPackages as public;
    }

    /**
     * {@inheritdoc}
     */
    public function collectionBuilder(): CollectionBuilder
    {
        /** @var \Robo\Tasks $null */
        $null = null;

        return CollectionBuilder::create($this->getContainer(), $null);
    }
}
