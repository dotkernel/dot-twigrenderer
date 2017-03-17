<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig\Factory;

use Dot\FlashMessenger\View\RendererInterface;
use Dot\Twig\Extension\FlashMessengerExtension;
use Psr\Container\ContainerInterface;

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
