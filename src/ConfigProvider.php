<?php

declare(strict_types=1);

namespace Dot\Twig;

use DoctrineModule\Service\Authentication\AuthenticationServiceFactory;
use Dot\FlashMessenger\View\FlashMessengerRenderer;
use Dot\Navigation\View\NavigationRenderer;
use Dot\Twig\Extension\AuthenticationExtension;
use Dot\Twig\Extension\AuthorizationExtension;
use Dot\Twig\Extension\FlashMessengerExtension;
use Dot\Twig\Extension\FormElementsExtension;
use Dot\Twig\Extension\NavigationExtension;
use Dot\Twig\Factory\AuthenticationExtensionFactory;
use Dot\Twig\Factory\AuthorizationExtensionFactory;
use Dot\Twig\Factory\FlashMessengerExtensionFactory;
use Dot\Twig\Factory\NavigationExtensionFactory;
use Dot\Twig\Laminas\View\HelperPluginManagerFactory;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\ServiceManager\Proxy\LazyServiceFactory;
use Laminas\View\HelperPluginManager;
use Twig\Environment;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
            'view_helpers' => [],
        ];
    }

    public function getDependencyConfig(): array
    {
        return [
            'factories'     => [
                HelperPluginManager::class     => HelperPluginManagerFactory::class,
                AuthenticationExtension::class => AuthenticationExtensionFactory::class,
                AuthorizationExtension::class  => AuthorizationExtensionFactory::class,
                NavigationExtension::class     => NavigationExtensionFactory::class,
                FlashMessengerExtension::class => FlashMessengerExtensionFactory::class,
                FormElementsExtension::class   => InvokableFactory::class,
                AuthenticationService::class   => AuthenticationServiceFactory::class,
            ],
            'delegators'    => [
                Environment::class            => [
                    TwigEnvironmentDelegator::class,
                ],
                FlashMessengerRenderer::class => [
                    LazyServiceFactory::class,
                ],
                NavigationRenderer::class     => [
                    LazyServiceFactory::class,
                ],
            ],
            'lazy_services' => [
                'class_map' => [
                    NavigationRenderer::class
                        => NavigationRenderer::class,
                    FlashMessengerRenderer::class
                        => FlashMessengerRenderer::class,
                ],
            ],
            'aliases'       => [
                'ViewHelperManager'                   => HelperPluginManager::class,
                AuthenticationServiceInterface::class => AuthenticationService::class,
            ],
        ];
    }
}
