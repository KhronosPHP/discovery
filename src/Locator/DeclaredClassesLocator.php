<?php

namespace Khronos\Discovery\Locator;

use Illuminate\Support\Collection;
use Khronos\Discovery\Descriptor\Class\ClassDescriptor;

final class DeclaredClassesLocator implements Locator
{
    public function getClasses(): Collection
    {
        return Collection::make(get_declared_classes())->map(
            fn (string $className) => ClassDescriptor::for($className)
        );
    }
}