<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig\Factory;

use Dot\Navigation\View\RendererInterface;
use Dot\Twig\Extension\NavigationExtension;
use Psr\Container\ContainerInterface;

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
