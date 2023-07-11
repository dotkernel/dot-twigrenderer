<?php

declare(strict_types=1);

namespace Dot\Twig\Extension;

use Dot\FlashMessenger\FlashMessengerInterface;
use Dot\FlashMessenger\View\RendererInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FlashMessengerExtension extends AbstractExtension
{
    protected RendererInterface $renderer;

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function getName(): string
    {
        return 'dot-messenger';
    }

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

    public function renderMessages(
        ?string $type = null,
        string $channel = FlashMessengerInterface::DEFAULT_CHANNEL
    ): string {
        return $this->renderer->render($type, $channel);
    }

    public function renderMessagesPartial(
        string $partial,
        array $params = [],
        ?string $type = null,
        string $channel = FlashMessengerInterface::DEFAULT_CHANNEL
    ): string {
        return $this->renderer->renderPartial($partial, $params, $type, $channel);
    }
}
