<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\Twig\Extension\AuthenticationExtension;
use Laminas\Authentication\AuthenticationServiceInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Twig\TwigFunction;

use function PHPUnit\Framework\assertInstanceOf;

class AuthenticationExtensionTest extends TestCase
{
    private AuthenticationServiceInterface|MockObject $interfaceMock;
    private AuthenticationExtension $extension;

    protected function setUp(): void
    {
        $this->interfaceMock = $this->createMock(AuthenticationServiceInterface::class);
        $this->extension     = new AuthenticationExtension($this->interfaceMock);
    }

    public function testCreate()
    {
        assertInstanceOf(AuthenticationExtension::class, $this->extension);
    }

    public function testFunctions()
    {
        foreach ($this->extension->getFunctions() as $function) {
            assertInstanceOf(TwigFunction::class, $function);
        }
    }
}
