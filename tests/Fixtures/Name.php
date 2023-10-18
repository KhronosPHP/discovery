<?php

namespace Khronos\Discovery\Tests\Fixtures;

class Name
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName
    ) {}
}