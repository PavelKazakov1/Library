<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Reflection;
use ReflectionClass;

abstract class AbstractTestCase extends TestCase
{
    protected function setEntityId(object $entity, int $value, $idField = 'id')
    {
        $class = new ReflectionClass($entity);
        $property = $class->getProperty($idField);
        $property->setAccessible(true);
        $property->setValue($entity, $value);
        $property->setAccessible(false);
    } 
}