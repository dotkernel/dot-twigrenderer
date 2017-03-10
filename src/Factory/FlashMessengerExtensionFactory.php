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

use Dot\FlashMessenger\View\RendererInterface;
use Dot\Twig\Extension\FlashMessengerExtension;
use Interop\Container\ContainerInterface;

/**
 * Class FlashMessengerExtensionFactory
 * @package Dot\Twig\Factory
 */
class FlashMessengerExtensionFactory
{
    /**
     * @param ContainerInterface $container
     * @return FlashMessengerExtension
     */
    public function __invoke(ContainerInterface $container)
    {
        return new FlashMessengerExtension($container->get(RendererInterface::class));
    }
}
