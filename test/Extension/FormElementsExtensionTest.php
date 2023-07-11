<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\Twig\Extension\FormElementsExtension;
use PHPUnit\Framework\TestCase;
use Twig\TwigTest;

class FormElementsExtensionTest extends TestCase
{
    public function testWillGetTests()
    {
        $extension = new FormElementsExtension();
        $twigTests = $extension->getTests();
        foreach ($twigTests as $element) {
            $this->assertInstanceOf(TwigTest::class, $element);
        }
    }
}
