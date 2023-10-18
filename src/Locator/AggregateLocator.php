<?php

namespace Khronos\Discovery\Locator;

use Illuminate\Support\Collection;

final class AggregateLocator implements Locator
{
    /** @var array<array-key,Locator> $locators */
    private array $locators = [];

    public function __construct(array $locators)
    {
        foreach ($locators as $locator) {
            $this->add($locator);
        }
    }

    public function add(Locator $locator): void
    {
        $this->locators[] = $locator;
    }

    public function getClasses(): Collection
    {
        $classes = new Collection();

        foreach ($this->locators as $locator) {
            $classes = $classes->merge($locator->getClasses());
        }

        return $classes;
    }
}