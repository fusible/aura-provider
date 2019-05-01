<?php

namespace Fusible\AuraProvider;

use Aura\Di\Container;
use Aura\Di\ContainerConfig;
use Interop\Container\ServiceProviderInterface as Provider;

/**
 * ProviderConfig
 * https://github.com/container-interop/service-provider
 *
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  https://jnj.mit-license.org/ MIT License
 * @link     https://jakejohns.net
 *
 * @see ContainerConfig
 */
class ProviderConfig extends ContainerConfig
{
    /**
     * Providers
     *
     * @var Provider[]
     *
     * @access protected
     */
    protected $providers = [];

    /**
     * __construct
     *
     * @param array $providers providers
     *
     * @access public
     */
    public function __construct(array $providers)
    {
        foreach ($providers as $provider) {
            $provider = $this->getProvider($provider);
            $this->providers[] = $provider;
        }
    }

    /**
     * Instantiate a a provider
     *
     * @param mixed $provider provider spec
     *
     * @return Provider
     *
     * @access protected
     */
    protected function getProvider($provider) : Provider
    {
        if (is_string($provider)) {
            $provider = new $provider;
        }

        return $provider;
    }

    /**
     * Define services from providers
     *
     * @param Container $container container
     *
     * @return null
     *
     * @access public
     */
    public function define(Container $container)
    {
        foreach ($this->providers as $provider) {
            $this->defineForProvider($container, $provider);
        }
    }

    /**
     * Define services from a provider
     *
     * @param Container $container container
     * @param Provider  $provider  provider
     *
     * @return void
     *
     * @access protected
     */
    protected function defineForProvider(Container $container, Provider $provider) : void
    {
        foreach($provider->getFactories() as $name => $factory) {
            $this->defineService($container, $name, $factory);
        }
    }

    /**
     * Define service
     *
     * @param Container $container container
     * @param string    $name      service name
     * @param callable  $factory   service factory
     *
     * @return void
     *
     * @access protected
     */
    protected function defineService(
        Container $container,
        string $name,
        callable $factory
    ) {
        $container->set($name, $container->lazy($factory, $container));
    }

    /**
     * Add provider extensions
     *
     * @param Container $container container
     *
     * @return null
     *
     * @access public
     */
    public function modify(Container $container)
    {
        foreach($this->providers as $provider) {
            $this->extendForProvider($container, $provider);
        }
    }

    /**
     * Extend for provider
     *
     * @param Container $container DESCRIPTION
     * @param Provider  $provider  DESCRIPTION
     *
     * @return void
     *
     * @access protected
     */
    protected function extendForProvider(Container $container, Provider $provider) : void
    {
        foreach($provider->getExtensions() as $name => $modify) {
            $this->extendService($container, $name, $modify);
        }
    }

    /**
     * Extend/modify a service
     *
     * @param Container $container container
     * @param string    $name      name of service to modify
     * @param callable  $modify    modification func
     *
     * @return void
     *
     * @access protected
     */
    protected function extendService(
        Container $container,
        string $name,
        callable $modify
    ) : void {
        if ($container->has($name)) {
            $modify($container, $container->get($name));
        }
    }
}
