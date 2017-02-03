<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-twigrenderer
 * @author: n3vrax
 * Date: 9/23/2016
 * Time: 8:14 PM
 */

declare(strict_types = 1);

namespace Dot\Twig\Zend\View;

use Interop\Container\ContainerInterface;
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
