<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-twigrenderer
 * @author: n3vrax
 * Date: 9/23/2016
 * Time: 10:01 PM
 */

namespace Dot\Twig\Extension;


use Dot\FlashMessenger\View\FlashMessengerRenderer;

/**
 * Class FlashMessengerExtension
 * @package Dot\Twig\Extension
 */
class FlashMessengerExtension extends \Twig_Extension
{
    /** @var FlashMessengerRenderer */
    protected $renderer;

    /**
     * @return string
     */
    public function getName()
    {
        return 'dot-flashmessenger';
    }

    /**
     * FlashMessengerExtension constructor.
     * @param FlashMessengerRenderer $renderer
     */
    public function __construct(FlashMessengerRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('flashMessagesRender',
                [$this, 'renderFlashMessages'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('flashMessagesPartial',
                [$this, 'renderFlashMessagesPartial'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param null $namespace
     * @return string
     */
    public function renderFlashMessages($namespace = null)
    {
        return $this->renderer->renderMessages($namespace);
    }

    /**
     * @param $partial
     * @param null $namespace
     * @param array $extra
     * @return string
     */
    public function renderFlashMessagesPartial($partial, $namespace = null, array $extra = [])
    {
        return $this->renderer->renderPartial($partial, $namespace, $extra);
    }
}