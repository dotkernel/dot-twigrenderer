<?php

declare(strict_types=1);

namespace Dot\Twig\Extension;

use Dot\Twig\Extension\Translation\TransTokenParser;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TranslationExtension extends AbstractExtension
{
    public function getTokenParsers(): array
    {
        return [new TransTokenParser()];
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('trans', 'gettext'),
        ];
    }
}
