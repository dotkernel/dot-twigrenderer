<?php

/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 */

declare(strict_types=1);

namespace Dot\Twig\Factory;

use Dot\Twig\Extension\AuthenticationExtension;
use Exception;
use Laminas\Authentication\AuthenticationServiceInterface;
use Psr\Container\ContainerInterface;

use function sprintf;

class AuthenticationExtensionFactory
{
    public function __invoke(ContainerInterface $container): AuthenticationExtension
    {
        $service = $container->has(AuthenticationServiceInterface::class) ?
            $container->get(AuthenticationServiceInterface::class) : null;

        if (! $service instanceof AuthenticationServiceInterface) {
            throw new Exception(sprintf('Unable to find %s', AuthenticationServiceInterface::class));
        }

        return new AuthenticationExtension($service);
    }
}
