<?php

/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 */

declare(strict_types=1);

namespace Dot\Twig\Extension;

use Dot\Authorization\AuthorizationInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AuthorizationExtension extends AbstractExtension
{
    /** @var AuthorizationInterface */
    protected $authorization;

    public function __construct(AuthorizationInterface $authorization)
    {
        $this->authorization = $authorization;
    }

    public function getName(): string
    {
        return 'dot-authorization';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('isGranted', [$this, 'isGranted']),
        ];
    }

    public function isGranted(string $permission = ''): bool
    {
        return $this->authorization->isGranted($permission);
    }
}
