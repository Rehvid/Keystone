<?php

declare(strict_types=1);

namespace Keystone\Shared\Infrastructure\Http\Provider;

use Keystone\Shared\Application\Provider\ExecutionContextProviderInterface;
use Keystone\Shared\Infrastructure\Http\Context\HttpExecutionContext;
use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\HttpFoundation\RequestStack;

#[AsAlias(ExecutionContextProviderInterface::class, public: true)]
final readonly class HttpExecutionContextProvider implements ExecutionContextProviderInterface
{
    public function __construct(
        private RequestStack $requestStack,
    ) {
    }

    public function load(): HttpExecutionContext
    {
        $request = $this->requestStack->getCurrentRequest();

        if (!$request) {
            throw new \RuntimeException('Cannot provide ExecutionContext: No active HTTP request found');
        }

        $context = $request->attributes->get(HttpExecutionContext::class);
        if (!$context instanceof HttpExecutionContext) {
            throw new \RuntimeException('ExecutionContext missing in request attributes');
        }

        return $context;
    }
}
