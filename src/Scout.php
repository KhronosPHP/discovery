<?php

namespace Khronos\Discovery;

use Illuminate\Support\Collection;
use Khronos\Discovery\Descriptor\Class\ClassDescriptor;
use Khronos\Discovery\Descriptor\Method\MethodDescriptor;
use Khronos\Discovery\Locator\ComposerLocator;
use Khronos\Discovery\Locator\Locator;

final class Scout
{
    public static function new(Locator $locator = new ComposerLocator()): self
    {
        return new self($locator);
    }

    public function __construct(private readonly Locator $locator = new ComposerLocator())
    {}

    /**
     * @return Collection<array-key,ClassDescriptor>
     */
    public function getClasses(): Collection
    {
        return $this->locator->getClasses();
    }

    /**
     * @return Collection<array-key,MethodDescriptor>
     */
    public function getMethods(): Collection
    {
        $methods = new Collection();

        foreach ($this->getClasses() as $class) {
            $methods = $methods->merge($class->getMethods());
        }

        return $methods;
    }
}