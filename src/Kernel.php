<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    public function registerBundles(): iterable
    {
        $contents = require $this->getProjectDir() . '/config/bundles.php';
        foreach ($contents as $class => $envs) {
            yield new $class();
        }
    }

    public function getProjectDir(): string
    {
        return \dirname(__DIR__);
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->addResource(new FileResource($this->getProjectDir() . '/config/bundles.php'));
        $container->setParameter('container.dumper.inline_class_loader',
            \PHP_VERSION_ID < 70400 || !(bool)ini_get('opcache.preload'));
        $container->setParameter('container.dumper.inline_factories', true);
        $confDir = $this->getProjectDir() . '/config';

        $this->_configureContainer($loader, $confDir);

        $modules = Finder::create()->directories()->in($confDir . '/modules');
        foreach ($modules as $module) {
            /* @var \SplFileInfo $module */
            $this->_configureContainer($loader, $module->getPathname());
        }
    }

    protected function _configureContainer(LoaderInterface $loader, string $confDir)
    {
        $loader->load($confDir . '/{packages}/*' . self::CONFIG_EXTS, 'glob');
        $loader->load($confDir . '/{packages}/' . $this->environment . '/*' . self::CONFIG_EXTS, 'glob');
        $loader->load($confDir . '/{services}' . self::CONFIG_EXTS, 'glob');
        $loader->load($confDir . '/{services}_' . $this->environment . self::CONFIG_EXTS, 'glob');
    }

    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
        $confDir = $this->getProjectDir() . '/config';

        $this->_configureRoutes($routes, $confDir);

        $modules = Finder::create()->directories()->in($confDir . '/modules');
        foreach ($modules as $module) {
            /* @var \SplFileInfo $module */
            $this->_configureRoutes($routes, $module->getPathname());
        }
    }

    protected function _configureRoutes(RouteCollectionBuilder $routes, string $confDir)
    {
        $routes->import($confDir . '/{routes}/' . $this->environment . '/*' . self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir . '/{routes}/*' . self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir . '/{routes}' . self::CONFIG_EXTS, '/', 'glob');
    }
}
