<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\Authorization\AuthorizationInterface;
use Dot\Twig\Extension\AuthorizationExtension;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Twig\TwigFunction;

class AuthorizationExtensionTest extends TestCase
{
    private AuthorizationExtension $extension;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $interfaceMock   = $this->createMock(AuthorizationInterface::class);
        $this->extension = new AuthorizationExtension($interfaceMock);
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf(AuthorizationExtension::class, $this->extension);
    }

    public function testFunctions(): void
    {
        foreach ($this->extension->getFunctions() as $function) {
            $this->assertInstanceOf(TwigFunction::class, $function);
        }
    }
}
