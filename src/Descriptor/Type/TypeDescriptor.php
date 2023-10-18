<?php

namespace Khronos\Discovery\Descriptor\Type;

use Illuminate\Support\Collection;
use ReflectionNamedType;
use ReflectionType;
use ReflectionUnionType;

final class TypeDescriptor
{
    /** @var Collection<array-key,ReflectionNamedType> $allowedTypes */
    private Collection $allowedTypes;

    /** @var Collection<array-key,string> $allowedTypeNames */
    private Collection $allowedTypeNames;

    public function __construct(private readonly null|ReflectionType|ReflectionNamedType|ReflectionUnionType $type)
    {}

    public function allows(string $type): bool
    {
        return $this->allowedTypeNames()->contains($type);
    }

    /**
     * @return Collection<array-key,ReflectionType|ReflectionNamedType|ReflectionUnionType>
     */
    private function allowedTypes(): Collection
    {
        return $this->allowedTypes ??= new Collection(
            $this->unwrapTypes()
        );
    }

    /**
     * @return Collection<array-key,string>
     */
    private function allowedTypeNames(): Collection
    {
        return $this->allowedTypeNames ??= $this->allowedTypes()->map(
            fn (ReflectionNamedType $type) => $type->getName()
        );
    }

    private function unwrapTypes(): array
    {
        return match (true) {
            $this->type instanceof ReflectionUnionType => $this->type->getTypes(),
            $this->type === null => [],
            default => [$this->type],
        };
    }
}