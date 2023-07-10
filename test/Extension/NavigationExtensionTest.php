<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\Navigation\NavigationContainer;
use Dot\Navigation\Page;
use Dot\Navigation\View\RendererInterface;
use Dot\Twig\Extension\NavigationExtension;
use PHPUnit\Framework\TestCase;
use Twig\TwigFunction;

class NavigationExtensionTest extends TestCase
{
    private NavigationExtension $extension;

    protected function setUp(): void
    {
        $interfaceMock   = $this->createMock(RendererInterface::class);
        $this->extension = new NavigationExtension($interfaceMock);
    }

    public function testCreate()
    {
        self::assertInstanceOf(NavigationExtension::class, $this->extension);
    }

    public function testFunctions()
    {
        foreach ($this->extension->getFunctions() as $function) {
            self::assertInstanceOf(TwigFunction::class, $function);
        }
    }

    public function testHtmlAttributes()
    {
        $page = new Page();
        self::assertIsString($this->extension->htmlAttributes($page));
    }

    public function testRenderMenu()
    {
        self::assertIsString($this->extension->renderMenu(new NavigationContainer()));
    }

    public function testRenderMenuPartial()
    {
        self::assertIsString($this->extension->renderMenuPartial(new NavigationContainer(), 'partial'));
    }
}
