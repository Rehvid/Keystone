<?php

declare(strict_types=1);

namespace Keystone\Shared\Infrastructure\Http\EventListener;

use Keystone\Shared\Infrastructure\Http\Context\ExecutionContext;
use Keystone\Shared\Infrastructure\Http\Factory\ExecutionContextFactory;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::REQUEST, priority: 100)]
final readonly class RequestListener
{
    public function __construct(
        private ExecutionContextFactory $factory,
    ) {
    }

    public function __invoke(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();
        $context = $this->factory->createFromRequest($request);

        $request->attributes->set(ExecutionContext::class, $context);
    }
}
