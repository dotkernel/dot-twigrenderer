<?php

declare(strict_types=1);

namespace DotTest\Twig\Laminas\View;

use Dot\Twig\Laminas\View\HelperPluginManagerFactory;
use Exception;
use Laminas\View\HelperPluginManager;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class HelperPluginManagerFactoryTest extends TestCase
{
    private ContainerInterface $container;

    /**
     * @throws Exception
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testWillNotInstantiateWithoutConfig()
    {
        $this->container->expects($this->once())
            ->method('has')
            ->with('config')
            ->willReturn(false);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unable to find config');
        (new HelperPluginManagerFactory())($this->container);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testWillNotInstantiateWithoutViewHelpers()
    {
        $this->container->expects($this->once())
            ->method('has')
            ->with('config')
            ->willReturn(true);

        $this->container->expects($this->once())
            ->method('get')
            ->with('config')
            ->willReturn([
                'test',
            ]);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unable to find view_helpers config');
        (new HelperPluginManagerFactory())($this->container);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testWillInstantiate()
    {
        $this->container->expects($this->once())
            ->method('has')
            ->with('config')
            ->willReturn(true);

        $this->container->expects($this->once())
            ->method('get')
            ->with('config')
            ->willReturn([
                'view_helpers' => [],
            ]);

        $factory = (new HelperPluginManagerFactory())($this->container);

        $this->assertInstanceOf(HelperPluginManager::class, $factory);
    }
}
