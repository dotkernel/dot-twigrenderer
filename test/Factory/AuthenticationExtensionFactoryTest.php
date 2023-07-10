<?php

declare(strict_types=1);

namespace DotTest\Twig\Factory;

use Dot\Twig\Extension\AuthenticationExtension;
use Dot\Twig\Factory\AuthenticationExtensionFactory;
use Laminas\Authentication\AuthenticationServiceInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

use function PHPUnit\Framework\assertInstanceOf;
use function sprintf;

class AuthenticationExtensionFactoryTest extends TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
    }

    /**
     * @throws \Exception
     */
    public function testWillNotInstantiateWithoutInterface()
    {
        $this->container->expects(self::once())
            ->method('has')
            ->with(AuthenticationServiceInterface::class)
            ->willReturn(false);
        $this->expectExceptionMessage(sprintf('Unable to find %s', AuthenticationServiceInterface::class));
        (new AuthenticationExtensionFactory())($this->container);
    }

    /**
     * @throws \Exception|Exception
     */
    public function testWillInstantiateWithInterface()
    {
        $this->container->expects(self::once())
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
