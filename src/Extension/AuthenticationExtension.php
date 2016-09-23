<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-twigrenderer
 * @author: n3vrax
 * Date: 9/23/2016
 * Time: 9:04 PM
 */

namespace Dot\Twig\Extension;


use Dot\Authentication\AuthenticationInterface;

/**
 * Class AuthenticationExtension
 * @package Dot\Twig\Extension
 */
class AuthenticationExtension extends \Twig_Extension
{
    /** @var AuthenticationInterface  */
    protected $authentication;

    /**
     * AuthenticationExtension constructor.
     * @param AuthenticationInterface $authentication
     */
    public function __construct(AuthenticationInterface $authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dot-authentication';
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('hasIdentity', [$this, 'hasIdentity']),
            new \Twig_SimpleFunction('getIdentity', [$this, 'getIdentity']),
        ];
    }

    public function hasIdentity()
    {
        return $this->authentication->hasIdentity();
    }

    public function getIdentity()
    {
        return $this->authentication->getIdentity();
    }

}