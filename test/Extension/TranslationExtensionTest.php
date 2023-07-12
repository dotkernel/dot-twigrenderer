<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\Twig\Extension\TranslationExtension;
use PHPUnit\Framework\TestCase;

class TranslationExtensionTest extends TestCase
{
    private TranslationExtension $extension;

    protected function setUp(): void
    {
        $this->extension = new TranslationExtension();
    }

    public function testTokenParsersIsArray(): void
    {
        $this->assertIsArray($this->extension->getTokenParsers());
    }
}
