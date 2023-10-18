<?php

namespace Khronos\Discovery\Locator;

use Illuminate\Support\Collection;
use Khronos\Discovery\Descriptor\Class\ClassDescriptor;
use RuntimeException;
use Throwable;

final class ComposerLocator implements Locator
{
    private string $composerClassmap;

    public function __construct()
    {
        $this->composerClassmap = getcwd() . '/vendor/composer/autoload_classmap.php';

        if (! file_exists($this->composerClassmap)) {
            throw new RuntimeException(sprintf(
                'Composer classmap does not exist at [%s].', $this->composerClassmap
            ));
        }
    }

    /**
     * @return Collection<array-key,ClassDescriptor>
     */
    public function getClasses(): Collection
    {
        return Collection::make(array_keys(require_once $this->composerClassmap))
            ->map(function (string $className) {
                try {
                    return ClassDescriptor::for($className);
                } catch (Throwable) {
                    return null;
                }
            })
            ->filter()
            ->values();
    }
}