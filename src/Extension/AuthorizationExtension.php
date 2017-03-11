<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig\Extension;

use Dot\Authorization\AuthorizationInterface;

/**
 * Class AuthorizationExtension
 * @package Dot\Twig\Extension
 */
class AuthorizationExtension extends \Twig_Extension
{
    /**
     * @var AuthorizationInterface
     */
    protected $authorization;

    public function __construct(AuthorizationInterface $authorization)
    {
        $this->authorization = $authorization;
    }

    public function getName(): string
    {
        return 'dot-authorization';
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('isGranted', [$this, 'isGranted']),
        ];
    }

    /**
     * @param $permission
     * @param array $roles
     * @param mixed $context
     * @return bool
     */
    public function isGranted(string $permission, array $roles = [], $context = null)
    {
        return $this->authorization->isGranted($permission, $roles, $context);
    }
}
