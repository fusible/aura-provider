<?php
// @codingStandardsIgnoreFile

namespace Fusible\AuraProvider;

use PHPUnit\Framework\TestCase;
use Aura\Di\ContainerBuilder;

class ProviderTest extends TestCase
{
    public function testProvider()
    {
        $builder = new ContainerBuilder();
        $container = $builder->newConfiguredInstance(
            [new ProviderConfig([FakeProvider::class])]
        );

        $service = $container->get(FakeService::class);
        $this->assertInstanceOf(FakeService::class, $service);
        $this->assertEquals('foo', $service->foo);
        $this->assertEquals('bar', $service->bar);
    }
}

