<?php

namespace Khronos\Discovery\Descriptor\Parameter;

use Khronos\Discovery\Descriptor\Type\TypeDescriptor;
use ReflectionParameter;

final class ParameterDescriptor
{
    private ReflectionParameter $parameter;

    private TypeDescriptor $types;

    public function __construct(ReflectionParameter $parameter)
    {
        $this->parameter = $parameter;
    }

    public function getTypes(): TypeDescriptor
    {
        return $this->types ??= new TypeDescriptor($this->parameter->getType());
    }

    public function allowsType(string $type): bool
    {
        return $this->getTypes()->allows($type);
    }

    public function isOptional(): bool
    {
        return $this->parameter->isOptional();
    }
}
