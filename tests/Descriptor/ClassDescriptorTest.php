<?php

namespace Khronos\Discovery\Tests\Descriptor;

use Khronos\Discovery\Descriptor\Class\ClassDescriptor;
use Khronos\Discovery\Tests\Fixtures\Contact;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ClassDescriptorTest extends TestCase
{
    public function test_creating_descriptors()
    {
        $descriptor1 = ClassDescriptor::for(Contact::class);
        $descriptor2 = ClassDescriptor::fromReflectionClass(
            new ReflectionClass(Contact::class)
        );

        $this->assertInstanceOf(ClassDescriptor::class, $descriptor1);
        $this->assertInstanceOf(ClassDescriptor::class, $descriptor2);
    }

    public function test_getting_methods()
    {
        $descriptor = ClassDescriptor::for(Contact::class);

        $methods = $descriptor->getMethods();

        $this->assertIsIterable($methods);
        $this->assertCount(1, $methods);
    }
}