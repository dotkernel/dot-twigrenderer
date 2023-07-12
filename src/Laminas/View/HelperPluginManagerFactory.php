<?php

declare(strict_types=1);

namespace Dot\Twig\Laminas\View;

use Exception;
use Laminas\View\HelperPluginManager;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function array_key_exists;

class HelperPluginManagerFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws Exception
     */
    public function __invoke(ContainerInterface $container): HelperPluginManager
    {
        if (! $container->has('config')) {
            throw new Exception('Unable to find config');
        }

        $config = $container->get('config');

        if (! array_key_exists('view_helpers', $config)) {
            throw new Exception('Unable to find view_helpers config');
        }

        return new HelperPluginManager($container, $config['view_helpers']);
    }
}
