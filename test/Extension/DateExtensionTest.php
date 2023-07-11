<?php

declare(strict_types=1);

namespace DotTest\Twig\Extension;

use Dot\Twig\Extension\DateExtension;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Extension\CoreExtension;
use Twig\TwigFilter;

class DateExtensionTest extends TestCase
{
    private DateExtension $extension;

    private MockObject|Environment $env;

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    protected function setUp(): void
    {
        $this->extension = new DateExtension();
        $coreExtension   = new CoreExtension();
        $this->env       = $this->createMock(Environment::class);
        $this->env->method('getExtension')->willReturn($coreExtension);
    }

    public function testFilters()
    {
        foreach ($this->extension->getFilters() as $filter) {
            $this->assertInstanceOf(TwigFilter::class, $filter);
        }
    }

    public function testDiffWillReturnString()
    {
        $this->assertIsString($this->extension->diff($this->env, "2023-07-31"));
    }

    public function testDiffWillReturnExceptionUnexpectedCharacters()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unexpected character');
        $this->extension->diff($this->env, '2023-23-3322');
    }

    public function testDiffWillReturnExceptionNotFoundMessage()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The timezone could not be found in the database');
        $this->extension->diff($this->env, 'asdas');
    }

    public function testPluralizedInterval()
    {
        $month = 'month'; //can be any word
        $this->assertSame('in 1 month', $this->extension->getPluralizedInterval(1, 1, $month));
        $this->assertSame('in 2 months', $this->extension->getPluralizedInterval(2, 1, $month));
        $this->assertSame('1 month ago', $this->extension->getPluralizedInterval(1, 0, $month));
        $this->assertSame('2 months ago', $this->extension->getPluralizedInterval(2, 0, $month));
    }
}
