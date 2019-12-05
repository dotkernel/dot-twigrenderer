<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig\Extension;

use Dot\FlashMessenger\FlashMessengerInterface;
use Dot\FlashMessenger\View\RendererInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class FlashMessengerExtension
 * @package Dot\Twig\Extension
 */
class FlashMessengerExtension extends AbstractExtension
{
    /** @var RendererInterface */
    protected $renderer;

    /**
     * FlashMessengerExtension constructor.
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'dot-messenger';
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'messages',
                [$this, 'renderMessages'],
                ['is_safe' => ['html']]
            ),
            new TwigFunction(
                'messagesPartial',
                [$this, 'renderMessagesPartial'],
                ['is_safe' => ['html']]
            ),
        ];
    }

    /**
     * @param string|null $type
     * @param string $channel
     * @return string
     */
    public function renderMessages(
        string $type = null,
        string $channel = FlashMessengerInterface::DEFAULT_CHANNEL
    ): string {
        return $this->renderer->render($type, $channel);
    }

    /**
     * @param string $partial
     * @param array $params
     * @param string|null $type
     * @param string $channel
     * @return string
     */
    public function renderMessagesPartial(
        string $partial,
        array $params = [],
        string $type = null,
        string $channel = FlashMessengerInterface::DEFAULT_CHANNEL
    ): string {
        return $this->renderer->renderPartial($partial, $params, $type, $channel);
    }
}
