<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig\Factory;

use Dot\Twig\Extension\AuthenticationExtension;
use Laminas\Authentication\AuthenticationServiceInterface;
use Psr\Container\ContainerInterface;

/**
 * Class AuthenticationExtensionFactory
 * @package Dot\Twig\Factory
 */
class AuthenticationExtensionFactory
{
    /**
     * @param ContainerInterface $container
     * @return AuthenticationExtension
     */
    public function __invoke(ContainerInterface $container)
    {
        return new AuthenticationExtension($container->get(AuthenticationServiceInterface::class));
    }
}
