<?php

declare(strict_types=1);

namespace DotTest\Twig;

use Dot\FlashMessenger\View\FlashMessengerRenderer;
use Dot\Navigation\View\NavigationRenderer;
use Dot\Twig\ConfigProvider;
use Dot\Twig\Extension\AuthenticationExtension;
use Dot\Twig\Extension\AuthorizationExtension;
use Dot\Twig\Extension\FlashMessengerExtension;
use Dot\Twig\Extension\FormElementsExtension;
use Dot\Twig\Extension\NavigationExtension;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\View\HelperPluginManager;
use PHPUnit\Framework\TestCase;
use Twig\Environment;

class ConfigProviderTest extends TestCase
{
    protected array $config;

    protected function setUp(): void
    {
        $this->config = (new ConfigProvider())();
    }

    public function testHasDependencies(): void
    {
        $this->assertArrayHasKey('dependencies', $this->config);
    }

    public function testDependenciesHasFactories(): void
    {
        $this->assertArrayHasKey('factories', $this->config['dependencies']);
        $this->assertArrayHasKey(HelperPluginManager::class, $this->config['dependencies']['factories']);
        $this->assertArrayHasKey(AuthenticationExtension::class, $this->config['dependencies']['factories']);
        $this->assertArrayHasKey(AuthorizationExtension::class, $this->config['dependencies']['factories']);
        $this->assertArrayHasKey(NavigationExtension::class, $this->config['dependencies']['factories']);
        $this->assertArrayHasKey(FlashMessengerExtension::class, $this->config['dependencies']['factories']);
        $this->assertArrayHasKey(FormElementsExtension::class, $this->config['dependencies']['factories']);
        $this->assertArrayHasKey(AuthenticationService::class, $this->config['dependencies']['factories']);
    }

    public function testDependenciesHasAliases(): void
    {
        $this->assertArrayHasKey('aliases', $this->config['dependencies']);
        $this->assertArrayHasKey('ViewHelperManager', $this->config['dependencies']['aliases']);
        $this->assertArrayHasKey(AuthenticationServiceInterface::class, $this->config['dependencies']['aliases']);
    }

    public function testDependenciesHasLazyServices()
    {
        $this->assertArrayHasKey('lazy_services', $this->config['dependencies']);
        $this->assertArrayHasKey('class_map', $this->config['dependencies']['lazy_services']);
        $this->assertArrayHasKey(
            NavigationRenderer::class,
            $this->config['dependencies']['lazy_services']['class_map']
        );
        $this->assertArrayHasKey(
            FlashMessengerRenderer::class,
            $this->config['dependencies']['lazy_services']['class_map']
        );
    }

    public function testDependenciesHasDelegators()
    {
        $this->assertArrayHasKey('delegators', $this->config['dependencies']);
        $this->assertArrayHasKey(Environment::class, $this->config['dependencies']['delegators']);
        $this->assertArrayHasKey(FlashMessengerRenderer::class, $this->config['dependencies']['delegators']);
        $this->assertArrayHasKey(NavigationRenderer::class, $this->config['dependencies']['delegators']);
    }
}
