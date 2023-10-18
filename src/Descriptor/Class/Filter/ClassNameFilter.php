<?php

namespace Khronos\Discovery\Descriptor\Class\Filter;

use Khronos\Discovery\Descriptor\Class\ClassDescriptor;

final class ClassNameFilter
{
    public function __construct(private readonly string $name)
    {}

    public function __invoke(ClassDescriptor $descriptor): bool
    {
        return $descriptor->getName() === $this->name;
    }
}