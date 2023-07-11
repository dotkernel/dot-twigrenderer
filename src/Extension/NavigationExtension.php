<?php

declare(strict_types=1);

namespace Dot\Twig\Extension;

use Dot\Navigation\NavigationContainer;
use Dot\Navigation\Page;
use Dot\Navigation\View\RendererInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class NavigationExtension extends AbstractExtension
{
    protected RendererInterface $navigationRenderer;

    public function __construct(RendererInterface $navigationRenderer)
    {
        $this->navigationRenderer = $navigationRenderer;
    }

    public function getName(): string
    {
        return 'dot-navigation';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('navigation', [$this, 'renderMenu'], ['is_safe' => ['html']]),
            new TwigFunction('navigationPartial', [$this, 'renderMenuPartial'], ['is_safe' => ['html']]),
            new TwigFunction('pageAttributes', [$this, 'htmlAttributes'], ['is_safe' => ['html']]),
        ];
    }

    public function htmlAttributes(Page $page): string
    {
        return $this->navigationRenderer->htmlAttributes($page->getAttributes());
    }

    public function renderMenu(NavigationContainer|string $container): string
    {
        return $this->navigationRenderer->render($container);
    }

    public function renderMenuPartial(
        NavigationContainer|string $container,
        string $partial,
        array $params = []
    ): string {
        return $this->navigationRenderer->renderPartial($container, $partial, $params);
    }
}
