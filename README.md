# fusible.aura-provider

[Service Providers] for [Aura\Di]


## Installation
```
composer require fusible/aura-provider
```

## Usage

See: [ Aura\Di > *Container Builder and Config Classes* ][Aura\Di docs].
```php
use Aura\Di\ContainerBuilder;
use Fusible\AuraProvider\ProviderConfig;


// Some providers implementing ServiceProviderInterface
$providers = [
    MyServiceProvider::class,
    OtherServiceProvider::class,
    new SomeServiceProvider($someConfig)
];

$builder = new ContainerBuilder();
$di = $builder->newConfiguredInstance(
    [new ProviderConfig($providers)]
);
```

[Service Providers]: https://github.com/container-interop/service-provider
[Aura\Di]:  https://github.com/auraphp/Aura.Di
[Aura\Di docs]: https://github.com/auraphp/Aura.Di/blob/3.x/docs/config.md
