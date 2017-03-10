<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-twigrenderer
 * @author: n3vrax
 * Date: 9/23/2016
 * Time: 10:01 PM
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
