<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use function MUtils\Objects\get_reflection_class;
use function MUtils\Objects\get_reflection_method;
use function MUtils\Objects\get_reflection_property;

final class ObjectsTest extends TestCase
{
    public function testGetReflectionClassReturnsNullIfNullProvided(): void
    {
        $this->assertNull(get_reflection_class(null));
    }

    public function testGetReflectionClassReturnsObject(): void
    {
        $this->assertInstanceOf(ReflectionClass::class, get_reflection_class(new Dummy()));
    }

    public function testGetReflectionMethodReturnsNullForUnknownMethod()
    {
        $this->assertNull(get_reflection_method(new Dummy(), 'foo'));
    }

    public function testGetReflectionMethodReturnsObject()
    {
        $instance = new Dummy();

        $method = get_reflection_method($instance, 'publicMethod');
        $this->assertInstanceOf(ReflectionMethod::class, $method);
        $this->assertEquals('public', $method->invoke($instance, 'public'));

        $method = get_reflection_method($instance, 'protectedMethod');
        $this->assertInstanceOf(ReflectionMethod::class, $method);
        $this->assertEquals('protected', $method->invoke($instance, 'protected'));

        $method = get_reflection_method($instance, 'privateMethod');
        $this->assertInstanceOf(ReflectionMethod::class, $method);
        $this->assertEquals('private', $method->invoke($instance, 'private'));
    }

    public function testGetReflectionPropertyReturnsNullForUnknownProperty()
    {
        $this->assertNull(get_reflection_property(new Dummy(), 'foo'));
    }

    public function testGetReflectionPropertyReturnsObject()
    {
        $instance = new Dummy();

        $property = get_reflection_property($instance, 'publicProperty');
        $this->assertInstanceOf(ReflectionProperty::class, $property);
        $this->assertEquals('public', $property->getValue($instance));

        $property = get_reflection_property($instance, 'protectedProperty');
        $this->assertInstanceOf(ReflectionProperty::class, $property);
        $this->assertEquals('protected', $property->getValue($instance));

        $property = get_reflection_property($instance, 'privateProperty');
        $this->assertInstanceOf(ReflectionProperty::class, $property);
        $this->assertEquals('private', $property->getValue($instance));
    }
}

class Dummy
{
    public $publicProperty = 'public';
    protected $protectedProperty = 'protected';
    private $privateProperty = 'private';

    public function publicMethod(string $arg1): string
    {
        return $arg1;
    }

    protected function protectedMethod(string $arg1): string
    {
        return $arg1;
    }

    private function privateMethod(string $arg1): string
    {
        return $arg1;
    }
}
