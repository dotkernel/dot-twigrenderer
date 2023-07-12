<?php

declare(strict_types=1);

namespace DotTest\Twig\Factory;

use Dot\Authorization\AuthorizationInterface;
use Dot\Twig\Extension\AuthorizationExtension;
use Dot\Twig\Factory\AuthorizationExtensionFactory;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function sprintf;

class AuthorizationExtensionFactoryTest extends TestCase
{
    private ContainerInterface|MockObject $container;

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
    public function testWillNotInstantiateWithoutInterface(): void
    {
        $this->container->expects($this->once())
            ->method('has')
            ->with(AuthorizationInterface::class)
            ->willReturn(false);
        $this->expectExceptionMessage(sprintf('Unable to find %s', AuthorizationInterface::class));
        (new AuthorizationExtensionFactory())($this->container);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function testWillInstantiateWithInterface(): void
    {
        $this->container->expects($this->once())
            ->method('has')
            ->with(AuthorizationInterface::class)
            ->willReturn(true);

        $interface = $this->createMock(AuthorizationInterface::class);
        $this->container->method('get')
            ->willReturnMap([
                [AuthorizationInterface::class, $interface],
            ]);

        $factory = (new AuthorizationExtensionFactory())($this->container);

        self::assertInstanceOf(AuthorizationExtension::class, $factory);
    }
}
