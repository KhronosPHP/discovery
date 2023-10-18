<?php

namespace Khronos\Discovery\Tests\Descriptor;

use Khronos\Discovery\Descriptor\Method\MethodDescriptor;
use Khronos\Discovery\Descriptor\Parameter\ParameterDescriptor;
use Khronos\Discovery\Tests\Fixtures\Contact;
use Khronos\Discovery\Tests\Fixtures\Name;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class MethodDescriptorTest extends TestCase
{
    public function test_creating_descriptor()
    {
        $descriptor1 = MethodDescriptor::for(Contact::class, 'changeName');
        $descriptor2 = MethodDescriptor::fromReflectionMethod(
            new ReflectionMethod(Contact::class, 'changeName')
        );

        $this->assertInstanceOf(MethodDescriptor::class, $descriptor1);
        $this->assertInstanceOf(MethodDescriptor::class, $descriptor2);
    }

    public function test_getting_name()
    {
        $descriptor = MethodDescriptor::for(Contact::class, 'changeName');

        $this->assertSame('changeName', $descriptor->getName());
    }

    public function test_getting_parameters()
    {
        $descriptor = MethodDescriptor::for(Contact::class, 'changeName');

        $parameters = $descriptor->getParameters();

        $this->assertCount(1, $parameters);
        $this->assertContainsOnlyInstancesOf(ParameterDescriptor::class, $parameters);
    }

    public function test_has_parameter_type()
    {
        $descriptor = MethodDescriptor::for(Contact::class, 'changeName');

        $this->assertTrue($descriptor->hasParameterType(Name::class));
        $this->assertFalse($descriptor->hasParameterType(Contact::class));
    }
}