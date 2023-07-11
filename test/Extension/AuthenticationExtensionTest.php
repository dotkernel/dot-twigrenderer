<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\Twig\Extension\AuthenticationExtension;
use Laminas\Authentication\AuthenticationServiceInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Twig\TwigFunction;

class AuthenticationExtensionTest extends TestCase
{
    private AuthenticationExtension $extension;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $interfaceMock   = $this->createMock(AuthenticationServiceInterface::class);
        $this->extension = new AuthenticationExtension($interfaceMock);
    }

    public function testCreate()
    {
        $this->assertInstanceOf(AuthenticationExtension::class, $this->extension);
    }

    public function testFunctions()
    {
        foreach ($this->extension->getFunctions() as $function) {
            $this->assertInstanceOf(TwigFunction::class, $function);
        }
    }
}
