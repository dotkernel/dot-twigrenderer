<?php

declare(strict_types=1);

namespace Dot\Twig\Factory;

use Dot\Navigation\View\RendererInterface;
use Dot\Twig\Extension\NavigationExtension;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function sprintf;

class NavigationExtensionFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function __invoke(ContainerInterface $container): NavigationExtension
    {
        $renderInterface = $container->has(RendererInterface::class) ?
            $container->get(RendererInterface::class) : null;

        if (! $renderInterface instanceof RendererInterface) {
            throw new Exception(sprintf('Unable to find %s', RendererInterface::class));
        }

        return new NavigationExtension($renderInterface);
    }
}
