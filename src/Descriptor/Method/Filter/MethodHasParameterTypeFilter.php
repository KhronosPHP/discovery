<?php

namespace Khronos\Discovery\Descriptor\Method\Filter;

use Khronos\Discovery\Descriptor\Method\MethodDescriptor;

final class MethodHasParameterTypeFilter
{
    public function __construct(private readonly string $type)
    {}

    public function __invoke(MethodDescriptor $descriptor): bool
    {
        return $descriptor->hasParameterType($this->type);
    }
}