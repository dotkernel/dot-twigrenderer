<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\Navigation\NavigationContainer;
use Dot\Navigation\Page;
use Dot\Navigation\View\RendererInterface;
use Dot\Twig\Extension\NavigationExtension;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Twig\TwigFunction;

class NavigationExtensionTest extends TestCase
{
    private NavigationExtension $extension;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $interfaceMock   = $this->createMock(RendererInterface::class);
        $this->extension = new NavigationExtension($interfaceMock);
    }

    public function testCreate()
    {
        $this->assertInstanceOf(NavigationExtension::class, $this->extension);
    }

    public function testFunctions()
    {
        foreach ($this->extension->getFunctions() as $function) {
            $this->assertInstanceOf(TwigFunction::class, $function);
        }
    }

    public function testHtmlAttributes()
    {
        $page = new Page();
        $this->assertIsString($this->extension->htmlAttributes($page));
    }

    public function testRenderMenu()
    {
        $this->assertIsString($this->extension->renderMenu(new NavigationContainer()));
    }

    public function testRenderMenuPartial()
    {
        $this->assertIsString($this->extension->renderMenuPartial(new NavigationContainer(), 'partial'));
    }
}
