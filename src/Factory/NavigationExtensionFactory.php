<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-twigrenderer
 * @author: n3vrax
 * Date: 9/23/2016
 * Time: 8:49 PM
 */

namespace Dot\Twig\Factory;

use Dot\Navigation\View\RendererInterface;
use Dot\Twig\Extension\NavigationExtension;
use Interop\Container\ContainerInterface;

/**
 * Class NavigationExtensionFactory
 * @package Dot\Twig\Factory
 */
class NavigationExtensionFactory
{
    /**
     * @param ContainerInterface $container
     * @return NavigationExtension
     */
    public function __invoke(ContainerInterface $container)
    {
        $navigationMenu = $container->get(RendererInterface::class);
        return new NavigationExtension($navigationMenu);
    }
}
