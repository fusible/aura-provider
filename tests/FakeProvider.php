<?php
// @codingStandardsIgnoreFile

namespace Fusible\AuraProvider;
use Interop\Container\ServiceProviderInterface as Provider;
use Psr\Container\ContainerInterface as Container;

class FakeProvider implements Provider
{

    public function getFactories() : array
    {
        return [
            FakeService::class => function (Container $container) {
                $container;
                return new FakeService('foo');
            }
        ];
    }

    public function getExtensions() : array
    {
        return [
            FakeService::class => function (Container $container, FakeService $service) {
                $container;
                $service->bar('bar');
            }
        ];
    }
}
