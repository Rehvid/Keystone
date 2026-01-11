<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Factory;

use Keystone\Shared\Application\Provider\ExecutionContextProviderInterface;
use Keystone\Shared\Application\Response\Meta\AppMeta;
use Keystone\Shared\Application\ValueObject\ExecutionContext;

final readonly class MetaPayloadFactory
{
    private ExecutionContext $executionContext;

    public function __construct(
        ExecutionContextProviderInterface $contextProvider,
    ) {
        $this->executionContext = $contextProvider->load();
    }

    public function createAppMeta(): AppMeta
    {
        return new AppMeta(
            requestId: $this->executionContext->id(),
            timestamp: $this->executionContext->startedAtFormatted(),
        );
    }
}
