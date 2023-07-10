<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\FlashMessenger\View\RendererInterface;
use Dot\Twig\Extension\FlashMessengerExtension;
use PHPUnit\Framework\TestCase;
use Twig\TwigFunction;

use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertIsString;

class FlashMessengerExtensionTest extends TestCase
{
    private FlashMessengerExtension $extension;

    protected function setUp(): void
    {
        $interfaceMock   = $this->createMock(RendererInterface::class);
        $this->extension = new FlashMessengerExtension($interfaceMock);
    }

    public function testCreate()
    {
        self::assertInstanceOf(FlashMessengerExtension::class, $this->extension);
    }

    public function testFunctions()
    {
        foreach ($this->extension->getFunctions() as $function) {
            assertInstanceOf(TwigFunction::class, $function);
        }
    }

    public function testWillRenderMessages()
    {
        assertIsString($this->extension->renderMessages());
    }

    public function testWillRenderMessagesPartial()
    {
        assertIsString($this->extension->renderMessagesPartial('partial string'));
    }
}
