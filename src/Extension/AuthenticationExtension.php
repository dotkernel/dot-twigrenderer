<?php

declare(strict_types=1);

namespace Dot\Twig\Extension;

use Laminas\Authentication\AuthenticationServiceInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AuthenticationExtension extends AbstractExtension
{
    protected AuthenticationServiceInterface $authentication;

    public function __construct(AuthenticationServiceInterface $authentication)
    {
        $this->authentication = $authentication;
    }

    public function getName(): string
    {
        return 'dot-authentication';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('hasIdentity', [$this, 'hasIdentity']),
            new TwigFunction('getIdentity', [$this, 'getIdentity']),
        ];
    }

    public function hasIdentity(): bool
    {
        return $this->authentication->hasIdentity();
    }

    public function getIdentity(): mixed
    {
        return $this->authentication->getIdentity();
    }
}
