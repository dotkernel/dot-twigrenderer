<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-twigrenderer
 * @author: n3vrax
 * Date: 9/23/2016
 * Time: 9:05 PM
 */

namespace Dot\Twig;

use Dot\Twig\Extension\AuthenticationExtension;
use Dot\Twig\Extension\AuthorizationExtension;
use Dot\Twig\Extension\FlashMessengerExtension;
use Dot\Twig\Extension\FormElementsExtension;
use Dot\Twig\Extension\NavigationExtension;
use Dot\Twig\Factory\AuthenticationExtensionFactory;
use Dot\Twig\Factory\AuthorizationExtensionFactory;
use Dot\Twig\Factory\FlashMessengerExtensionFactory;
use Dot\Twig\Factory\NavigationExtensionFactory;
use Dot\Twig\Zend\View\HelperPluginManagerFactory;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\View\HelperPluginManager;


/**
 * Class ConfigProvider
 * @package Dot\Twig
 */
class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencyConfig(),

            'view_helpers' => [],
        ];
    }

    public function getDependencyConfig()
    {
        return [
            'factories' => [
                HelperPluginManager::class => HelperPluginManagerFactory::class,

                AuthenticationExtension::class => AuthenticationExtensionFactory::class,
                AuthorizationExtension::class => AuthorizationExtensionFactory::class,
                NavigationExtension::class => NavigationExtensionFactory::class,
                FlashMessengerExtension::class => FlashMessengerExtensionFactory::class,
                FormElementsExtension::class => InvokableFactory::class,
            ],

            'delegators' => [
                TemplateRendererInterface::class => [
                    TwigRendererDelegator::class,
                ]
            ],

            'aliases' => [
                'ViewHelperManager' => HelperPluginManager::class,
            ],
        ];
    }
}