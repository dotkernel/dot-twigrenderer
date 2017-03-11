<?php
/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-twigrenderer/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Twig;

use Dot\Authentication\AuthenticationInterface;
use Dot\Authorization\AuthorizationInterface;
use Dot\FlashMessenger\View\RendererInterface as FlashMessengerRendererInterface;
use Dot\Navigation\View\RendererInterface as NavigationRendererInterface;
use Dot\Twig\Extension\AuthenticationExtension;
use Dot\Twig\Extension\AuthorizationExtension;
use Dot\Twig\Extension\FlashMessengerExtension;
use Dot\Twig\Extension\FormElementsExtension;
use Dot\Twig\Extension\NavigationExtension;
use Interop\Container\ContainerInterface;
use Zend\Form\Form;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;

/**
 * Class TwigEnvironmentDelegator
 * @package Dot\Twig
 */
class TwigEnvironmentDelegator implements DelegatorFactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $name,
        callable $callback,
        array $options = null
    ) {
        /** @var \Twig_Environment $environment */
        $environment = $callback();

        //add the zend view helpers to twig
        /** @var HelperPluginManager $viewHelperManager */
        $viewHelperManager = $container->get('ViewHelperManager');
        $zfRenderer = new PhpRenderer();
        $zfRenderer->setHelperPluginManager($viewHelperManager);
        $environment->registerUndefinedFunctionCallback(
            function ($name) use ($viewHelperManager, $zfRenderer) {
                if (!$viewHelperManager->has($name)) {
                    return false;
                }

                $callable = [$zfRenderer->plugin($name), '__invoke'];
                $options = ['is_safe' => ['html']];
                return new \Twig_SimpleFunction($name, $callable, $options);
            }
        );

        //add our default extensions, if dependencies are present
        if ($container->has(AuthenticationInterface::class)) {
            $environment->addExtension($container->get(AuthenticationExtension::class));
        }

        if ($container->has(AuthorizationInterface::class)) {
            $environment->addExtension($container->get(AuthorizationExtension::class));
        }

        if ($container->has(NavigationRendererInterface::class)) {
            $environment->addExtension($container->get(NavigationExtension::class));
        }

        if ($container->has(FlashMessengerRendererInterface::class)) {
            $environment->addExtension($container->get(FlashMessengerExtension::class));
        }

        if (class_exists(Form::class)) {
            $environment->addExtension($container->get(FormElementsExtension::class));
        }

        return $environment;
    }
}
