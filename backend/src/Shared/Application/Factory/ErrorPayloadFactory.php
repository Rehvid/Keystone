<?php

declare(strict_types=1);

namespace Keystone\Shared\Application\Factory;

use Keystone\Shared\Application\Response\Error\ErrorDetail;
use Keystone\Shared\Application\Response\Error\ErrorPayload;

final class ErrorPayloadFactory
{
    public function createErrorPayload(string $code, string $message, ErrorDetail ...$details): ErrorPayload
    {
        return new ErrorPayload(
            code: $code,
            message: $message,
            details: $details,
        );
    }

    /** @param array<string, mixed> $details */
    public function createErrorDetail(string $code, string $message, ?string $path = null, array $details = []): ErrorDetail
    {
        return new ErrorDetail(
            code: $code,
            message: $message,
            path: $path,
            details: $details,
        );
    }
}
