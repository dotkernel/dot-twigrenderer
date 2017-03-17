<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig\Zend\View;

use Psr\Container\ContainerInterface;
use Zend\View\HelperPluginManager;

/**
 * Class HelperPluginManagerFactory
 * @package Dot\Twig\Zend\View
 */
class HelperPluginManagerFactory
{
    /**
     * @param ContainerInterface $container
     * @return HelperPluginManager
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['view_helpers'];
        return new HelperPluginManager($container, $config);
    }
}
