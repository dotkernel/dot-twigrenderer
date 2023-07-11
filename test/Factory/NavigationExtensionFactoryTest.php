<?php

declare(strict_types=1);

namespace DotTest\Twig\Factory;

use Dot\Navigation\View\RendererInterface;
use Dot\Twig\Extension\NavigationExtension;
use Dot\Twig\Factory\NavigationExtensionFactory;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function sprintf;

class NavigationExtensionFactoryTest extends TestCase
{
    private ContainerInterface $container;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testWillNotInstantiateWithoutInterface()
    {
        $this->container->expects($this->once())
            ->method('has')
            ->with(RendererInterface::class)
            ->willReturn(false);

        $this->expectExceptionMessage(sprintf('Unable to find %s', RendererInterface::class));
        (new NavigationExtensionFactory())($this->container);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function testWillInstantiateWithInterface()
    {
        $this->container->expects($this->once())
            ->method('has')
            ->with(RendererInterface::class)
            ->willReturn(true);

        $interface = $this->createMock(RendererInterface::class);
        $this->container->method('get')
            ->willReturnMap([
                [RendererInterface::class, $interface],
            ]);

        $factory = (new NavigationExtensionFactory())($this->container);

        self::assertInstanceOf(NavigationExtension::class, $factory);
    }
}
