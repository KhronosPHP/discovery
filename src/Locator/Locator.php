<?php

namespace Khronos\Discovery\Locator;

use Illuminate\Support\Collection;
use Khronos\Discovery\Descriptor\Class\ClassDescriptor;

interface Locator
{
    /** @return Collection<array-key,ClassDescriptor> */
    public function getClasses(): Collection;
}