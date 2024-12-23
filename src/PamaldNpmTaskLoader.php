<?php

declare(strict_types = 1);

namespace Pamald\Robo\PamaldNpm;

use League\Container\ContainerAwareInterface;
use Robo\Collection\CollectionBuilder;

trait PamaldNpmTaskLoader
{
    /**
     * @phpstan-param robo-pamald-npm-collect-packages-task-options $options
     *
     * @return \Pamald\Robo\PamaldNpm\Task\CollectNpmPackagesTask|\Robo\Collection\CollectionBuilder
     */
    protected function taskPamaldCollectNpmPackages(array $options = []): CollectionBuilder
    {
        /** @var \Pamald\Robo\PamaldNpm\Task\CollectNpmPackagesTask|\Robo\Collection\CollectionBuilder $task */
        $task = $this->task(Task\CollectNpmPackagesTask::class);
        $task->setOptions($options);

        return $task;
    }

    /**
     * @phpstan-param robo-pamald-modify-commit-msg-parts-task-options $options
     *
     * @return \Pamald\Robo\PamaldNpm\Task\ModifyCommitMsgPartsTask|\Robo\Collection\CollectionBuilder
     */
    protected function taskPamaldNpmModifyCommitMsgParts(array $options = []): CollectionBuilder
    {
        /** @var \Pamald\Robo\PamaldNpm\Task\ModifyCommitMsgPartsTask|\Robo\Collection\CollectionBuilder $task */
        $task = $this->task(Task\ModifyCommitMsgPartsTask::class);
        if ($this instanceof ContainerAwareInterface) {
            $task->setContainer($this->getContainer());
        }

        $task->setOptions($options);

        return $task;
    }
}
