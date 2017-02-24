<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-twigrenderer
 * @author: n3vrax
 * Date: 9/23/2016
 * Time: 8:49 PM
 */

declare(strict_types = 1);

namespace Dot\Twig\Extension;

use Dot\Navigation\Page;
use Dot\Navigation\View\RendererInterface;

/**
 * Class NavigationExtension
 * @package Dot\Twig\Extension
 */
class NavigationExtension extends \Twig_Extension
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
            new \Twig_SimpleFunction('navigation', [$this, 'renderMenu'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('navigationPartial', [$this, 'renderMenuPartial'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('pageAttributes', [$this, 'htmlAttributes'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function htmlAttributes(Page $page): string
    {
        return $this->navigationRenderer->htmlAttributes($page->getAttributes());
    }

    /**
     * @param string $container
     * @return string
     */
    public function renderMenu(string $container): string
    {
        return $this->navigationRenderer->render($container);
    }

    /**
     * @param string $container
     * @param string $partial
     * @param array $params
     * @return string
     */
    public function renderMenuPartial(string $container, string $partial, array $params = []): string
    {
        return $this->navigationRenderer->renderPartial($container, $partial, $params);
    }
}
