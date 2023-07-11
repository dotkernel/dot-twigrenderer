<?php

/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 */

declare(strict_types=1);

namespace Dot\Twig\Factory;

use Dot\Authorization\AuthorizationInterface;
use Dot\Twig\Extension\AuthorizationExtension;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function sprintf;

class AuthorizationExtensionFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function __invoke(ContainerInterface $container): AuthorizationExtension
    {
        $authorizationInterface = $container->has(AuthorizationInterface::class) ?
            $container->get(AuthorizationInterface::class) : null;

        if (! $authorizationInterface instanceof AuthorizationInterface) {
            throw new Exception(sprintf('Unable to find %s', AuthorizationInterface::class));
        }

        return new AuthorizationExtension($authorizationInterface);
    }
}
