<?php

declare(strict_types=1);

namespace DotTest\Twig;

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

class ConfigProviderTest extends TestCase
{
    protected array $config;

    protected function setUp(): void
    {
        $this->config = (new ConfigProvider())();
    }

    public function testHasDependencies(): void
    {
        self::assertArrayHasKey('dependencies', $this->config);
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
        $this->assertArrayHasKey(AuthenticationServiceInterface::class, $this->config['dependencies']['aliases']);
    }
}
