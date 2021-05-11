<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Messenger\Wrapper;

use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;

trait MessengerDispatchWrapperTrait
{
    private function dispatchWrapped(MessageBusInterface $bus, object $message): void
    {
        try {
            $bus->dispatch($message);
        } catch (\Throwable $throwable) {
            throw $this->convertException($throwable);
        }
    }

    private function convertException(\Throwable $throwable): \Throwable
    {
        if ($throwable instanceof HandlerFailedException) {
            return count($throwable->getNestedExceptions()) > 0 ?
                $throwable->getNestedExceptions()[0] : $throwable;
        }

        return $throwable;
    }
}
