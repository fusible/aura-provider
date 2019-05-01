<?php
// @codingStandardsIgnoreFile

namespace Fusible\AuraProvider;

class FakeService
{
    public $foo;
    public $bar;

    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    public function bar($bar)
    {
        $this->bar = $bar;
    }

}
