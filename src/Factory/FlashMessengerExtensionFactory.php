<?php

/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 */

declare(strict_types=1);

namespace Dot\Twig\Factory;

use Dot\FlashMessenger\View\RendererInterface;
use Dot\Twig\Extension\FlashMessengerExtension;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function sprintf;

class FlashMessengerExtensionFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function __invoke(ContainerInterface $container): FlashMessengerExtension
    {
        $renderInterface = $container->has(RendererInterface::class) ?
            $container->get(RendererInterface::class) : null;

        if (! $renderInterface instanceof RendererInterface) {
            throw new Exception(sprintf('Unable to find %s', RendererInterface::class));
        }

        return new FlashMessengerExtension($renderInterface);
    }
}
