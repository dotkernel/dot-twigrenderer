<?php

declare(strict_types=1);

namespace DotTest\Twig\Factory;

use Dot\Twig\Extension\AuthenticationExtension;
use Dot\Twig\Factory\AuthenticationExtensionFactory;
use Laminas\Authentication\AuthenticationServiceInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function PHPUnit\Framework\assertInstanceOf;
use function sprintf;

class AuthenticationExtensionFactoryTest extends TestCase
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
            ->with(AuthenticationServiceInterface::class)
            ->willReturn(false);
        $this->expectExceptionMessage(sprintf('Unable to find %s', AuthenticationServiceInterface::class));
        (new AuthenticationExtensionFactory())($this->container);
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
            ->with(AuthenticationServiceInterface::class)
            ->willReturn(true);

        $interface = $this->createMock(AuthenticationServiceInterface::class);
        $this->container->method('get')
            ->willReturnMap([
                [AuthenticationServiceInterface::class, $interface],
            ]);

        $factory = (new AuthenticationExtensionFactory())($this->container);

        assertInstanceOf(AuthenticationExtension::class, $factory);
    }
}
