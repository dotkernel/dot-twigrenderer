<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-twigrenderer
 * @author: n3vrax
 * Date: 9/23/2016
 * Time: 9:56 PM
 */

namespace Dot\Twig\Factory;


use Dot\Authentication\AuthenticationInterface;
use Dot\Twig\Extension\AuthenticationExtension;
use Interop\Container\ContainerInterface;

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
        return new AuthenticationExtension($container->get(AuthenticationInterface::class));
    }
}