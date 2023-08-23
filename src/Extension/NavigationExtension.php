<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig\Extension;

use Dot\Navigation\NavigationContainer;
use Dot\Navigation\Page;
use Dot\Navigation\View\RendererInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class NavigationExtension
 * @package Dot\Twig\Extension
 */
class NavigationExtension extends AbstractExtension
{
    /**
     * @var RendererInterface
     */
    protected $navigationRenderer;

    /**
     * NavigationExtension constructor.
     * @param RendererInterface $navigationRenderer
     */
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

    public function renderMenu(string|NavigationContainer $container, string $template = '', array $params = []): string
    {
        return $this->navigationRenderer->render($container, $template, $params);
    }

    public function renderMenuPartial(string|NavigationContainer $container, string $partial, array $params = []): string
    {
        return $this->navigationRenderer->renderPartial($container, $partial, $params);
    }
}
