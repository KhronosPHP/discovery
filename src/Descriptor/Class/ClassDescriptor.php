<?php

namespace Khronos\Discovery\Descriptor\Class;

use Illuminate\Support\Collection;
use Khronos\Discovery\Descriptor\Method\MethodDescriptor;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

final class ClassDescriptor
{
    /** @var Collection<array-key,MethodDescriptor> $methods */
    private Collection $methods;

    /**
     * @throws ReflectionException
     */
    public static function for(string|object $class): self
    {
        return new self(
            new ReflectionClass($class)
        );
    }

    public static function fromReflectionClass(ReflectionClass $reflectionClass): self
    {
        return new self($reflectionClass);
    }

    public function __construct(private ReflectionClass $reflectionClass)
    {}

    public function getName(): string
    {
        return $this->reflectionClass->getName();
    }

    /**
     * @return Collection<array-key,MethodDescriptor>
     */
    public function getMethods(): Collection
    {
        return $this->methods ??= new Collection(
            array_map(
                fn (ReflectionMethod $method) => MethodDescriptor::fromReflectionMethod($method),
                $this->reflectionClass->getMethods()
            )
        );
    }
}