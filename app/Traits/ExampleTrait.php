<?php
namespace App\Traits;

trait ExampleTrait
{
    public function printThis()
    {
        echo "Trait executed";
        // dd($this);
    }

    public function anotherMethod()
    {
        echo "Trait – anotherMethod() executed";
    }
}
