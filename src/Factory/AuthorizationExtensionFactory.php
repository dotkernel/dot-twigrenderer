<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig\Factory;

use Dot\Authorization\AuthorizationInterface;
use Dot\Twig\Extension\AuthorizationExtension;
use Interop\Container\ContainerInterface;

/**
 * Class AuthorizationExtensionFactory
 * @package Dot\Twig\Factory
 */
class AuthorizationExtensionFactory
{
    /**
     * @param ContainerInterface $container
     * @return AuthorizationExtension
     */
    public function __invoke(ContainerInterface $container)
    {
        return new AuthorizationExtension($container->get(AuthorizationInterface::class));
    }
}
