<?php

/**
 * @see https://github.com/dotkernel/dot-twigrenderer/ for the canonical source repository
 */

declare(strict_types=1);

namespace Dot\Twig;

use Dot\Authorization\AuthorizationInterface;
use Dot\FlashMessenger\View\RendererInterface as FlashMessengerRendererInterface;
use Dot\Navigation\View\RendererInterface as NavigationRendererInterface;
use Dot\Twig\Extension\AuthenticationExtension;
use Dot\Twig\Extension\AuthorizationExtension;
use Dot\Twig\Extension\FlashMessengerExtension;
use Dot\Twig\Extension\FormElementsExtension;
use Dot\Twig\Extension\NavigationExtension;
use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Form\Form;
use Laminas\View\HelperPluginManager;
use Laminas\View\Renderer\PhpRenderer;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\TwigFunction;

use function class_exists;

class TwigEnvironmentDelegator
{
    public function __invoke(
        ContainerInterface $container,
        string $name,
        callable $callback,
        ?array $options = null
    ): Environment {
        /** @var Environment $environment */
        $environment = $callback();

        //add the laminas view helpers to twig
        /** @var HelperPluginManager $viewHelperManager */
        $viewHelperManager = $container->get('ViewHelperManager');
        $zfRenderer        = new PhpRenderer();
        $zfRenderer->setHelperPluginManager($viewHelperManager);
        $environment->registerUndefinedFunctionCallback(
            function ($name) use ($viewHelperManager, $zfRenderer) {
                if (! $viewHelperManager->has($name)) {
                    return false;
                }

                $callable = [$zfRenderer->plugin($name), '__invoke'];
                $options  = ['is_safe' => ['html']];
                return new TwigFunction($name, $callable, $options);
            }
        );

        //add our default extensions, if dependencies are present
        if ($container->has(AuthenticationServiceInterface::class)) {
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
