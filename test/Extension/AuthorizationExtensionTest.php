<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\Authorization\AuthorizationInterface;
use Dot\Twig\Extension\AuthorizationExtension;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Twig\TwigFunction;

use function PHPUnit\Framework\assertInstanceOf;

class AuthorizationExtensionTest extends TestCase
{
    private AuthorizationInterface|MockObject $interfaceMock;
    private AuthorizationExtension $extension;

    protected function setUp(): void
    {
        $this->interfaceMock = $this->createMock(AuthorizationInterface::class);
        $this->extension     = new AuthorizationExtension($this->interfaceMock);
    }

    public function testCreate()
    {
        self::assertInstanceOf(AuthorizationExtension::class, $this->extension);
    }

    public function testFunctions()
    {
        foreach ($this->extension->getFunctions() as $function) {
            assertInstanceOf(TwigFunction::class, $function);
        }
    }
}
