<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig\Extension;

use Dot\Authentication\AuthenticationService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class AuthenticationExtension
 * @package Dot\Twig\Extension
 */
class AuthenticationExtension extends AbstractExtension
{
    /** @var AuthenticationService */
    protected $authentication;

    /**
     * AuthenticationExtension constructor.
     * @param AuthenticationService $authentication
     */
    public function __construct(AuthenticationService $authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'dot-authentication';
    }

    public function getFunctions()
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

    public function getIdentity()
    {
        return $this->authentication->getIdentity();
    }
}
