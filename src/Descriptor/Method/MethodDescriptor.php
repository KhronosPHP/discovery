<?php

namespace Khronos\Discovery\Descriptor\Method;

use Illuminate\Support\Collection;
use Khronos\Discovery\Descriptor\Parameter\ParameterDescriptor;
use ReflectionMethod;
use ReflectionParameter;

final class MethodDescriptor
{
    private readonly ReflectionMethod $reflectionMethod;

    /** @var Collection<array-key,ParameterDescriptor> $parameters */
    private Collection $parameters;

    public static function for(string|object $class, string $method): self
    {
        return new self(
            new ReflectionMethod($class, $method)
        );
    }

    public static function fromReflectionMethod(ReflectionMethod $reflectionMethod): self
    {
        return new self($reflectionMethod);
    }

    public function __construct(ReflectionMethod $reflectionMethod)
    {
        $this->reflectionMethod = $reflectionMethod;
    }

    public function getName(): string
    {
        return $this->reflectionMethod->getName();
    }

    /**
     * @return Collection<array-key,ParameterDescriptor>
     */
    public function getParameters(): Collection
    {
        return $this->parameters ??= new Collection(
            array_map(
                fn (ReflectionParameter $parameter) => new ParameterDescriptor($parameter),
                $this->reflectionMethod->getParameters()
            )
        );
    }

    public function hasParameterType(string $type): bool
    {
        return $this->getParameters()->contains(
            fn (ParameterDescriptor $parameter) => $parameter->allowsType($type)
        );
    }
}