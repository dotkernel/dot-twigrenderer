<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\FlashMessenger\View\RendererInterface;
use Dot\Twig\Extension\FlashMessengerExtension;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Twig\TwigFunction;

class FlashMessengerExtensionTest extends TestCase
{
    private FlashMessengerExtension $extension;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $interfaceMock   = $this->createMock(RendererInterface::class);
        $this->extension = new FlashMessengerExtension($interfaceMock);
    }

    public function testCreate()
    {
        $this->assertInstanceOf(FlashMessengerExtension::class, $this->extension);
    }

    public function testFunctions()
    {
        foreach ($this->extension->getFunctions() as $function) {
            $this->assertInstanceOf(TwigFunction::class, $function);
        }
    }

    public function testWillRenderMessages()
    {
        $this->assertIsString($this->extension->renderMessages());
    }

    public function testWillRenderMessagesPartial()
    {
        $this->assertIsString($this->extension->renderMessagesPartial('partial string'));
    }
}
