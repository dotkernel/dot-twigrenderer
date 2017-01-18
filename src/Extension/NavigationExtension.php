<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-twigrenderer
 * @author: n3vrax
 * Date: 9/23/2016
 * Time: 8:49 PM
 */

namespace Dot\Twig\Extension;

use Dot\Navigation\NavigationContainer;
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

    public function getName()
    {
        return 'dot-navigation';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('navigationMenu', [$this, 'renderMenu'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('navigationPartial', [$this, 'renderPartial'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('navigationPageAttributes', [$this, 'htmlAttributes'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param Page $page
     * @return mixed
     */
    public function htmlAttributes(Page $page)
    {
        return $this->navigationRenderer->htmlAttributes($page->getAttributes());
    }

    /**
     * @param null|string|NavigationContainer $container
     * @return string
     */
    public function renderMenu($container = null)
    {
        return $this->navigationRenderer->renderMenu($container);
    }

    /**
     * @param null|string|NavigationContainer $container
     * @param string $partial
     * @param array $extra
     * @return string
     */
    public function renderPartial($container = null, $partial = null, array $extra = [])
    {
        return $this->navigationRenderer->renderPartial($container, $partial, $extra);
    }
}
