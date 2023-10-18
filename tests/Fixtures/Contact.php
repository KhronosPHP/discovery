<?php

namespace Khronos\Discovery\Tests\Fixtures;

class Contact
{
    private Name $name;

    public function changeName(Name $name): void
    {
        $this->name = $name;
    }
}