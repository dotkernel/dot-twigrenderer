<?php

namespace Dot\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Dot\Twig\Extension\Translation\TransTokenParser;

/**
 * Class TranslationExtension
 * @package Dot\Twig\Extension
 */
class TranslationExtension extends AbstractExtension
{
    /**
     * @return array|TransTokenParser[]|\Twig\TokenParser\TokenParserInterface[]
     */
    public function getTokenParsers()
    {
        return [new TransTokenParser()];
    }

    /**
     * @return array|TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('trans', 'gettext'),
        ];
    }
}
