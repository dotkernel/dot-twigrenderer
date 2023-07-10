<?php

declare(strict_types=1);

namespace DotTest\Twig\Factory;

use Dot\Authorization\AuthorizationInterface;
use Dot\Twig\Extension\AuthorizationExtension;
use Dot\Twig\Factory\AuthorizationExtensionFactory;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function sprintf;

class AuthorizationExtensionFactoryTest extends TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
    }

    /**
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function testWillNotInstantiateWithoutInterface()
    {
        $this->container->expects(self::once())
            ->method('has')
            ->with(AuthorizationInterface::class)
            ->willReturn(false);
        $this->expectExceptionMessage(sprintf('Unable to find %s', AuthorizationInterface::class));
        (new AuthorizationExtensionFactory())($this->container);
    }

    /**
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function testWillInstantiateWithInterface()
    {
        $this->container->expects(self::once())
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
