<?php

declare(strict_types=1);

namespace Keystone\Shared\Infrastructure\Http\Response;

use Keystone\Shared\Application\Response\AppPayload;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ApiResponse extends JsonResponse
{
    /** @param array<string, mixed> $headers */
    public function __construct(
        AppPayload $payload,
        int $status = self::HTTP_OK,
        array $headers = [],
    ) {
        parent::__construct(
            data: $payload->toArray(),
            status: $status,
            headers: $headers,
        );
    }
}
