<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Factory;

use Keystone\Shared\Application\Enum\StatusPayload;
use Keystone\Shared\Application\Response\AppPayload;
use Keystone\Shared\Application\Response\Error\ErrorPayload;
use Keystone\Shared\Application\Response\Meta\MetaPayloadInterface;

final readonly class AppPayloadFactory
{
    public function __construct(
        private MetaPayloadFactory $metaPayloadFactory,
    ) {
    }

    public function success(mixed $data, ?MetaPayloadInterface $metaPayload = null): AppPayload
    {
        return new AppPayload(
            status: StatusPayload::SUCCESS,
            metaPayload: $metaPayload ?? $this->metaPayloadFactory->createAppMeta(),
            data: $data,
        );
    }

    public function successEmpty(?MetaPayloadInterface $metaPayload = null): AppPayload
    {
        return new AppPayload(
            status: StatusPayload::SUCCESS_EMPTY,
            metaPayload: $metaPayload ?? $this->metaPayloadFactory->createAppMeta(),
        );
    }

    public function error(ErrorPayload $error, ?MetaPayloadInterface $metaPayload = null): AppPayload
    {
        return new AppPayload(
            status: StatusPayload::ERROR,
            metaPayload: $metaPayload ?? $this->metaPayloadFactory->createAppMeta(),
            errorPayload: $error,
        );
    }
}
