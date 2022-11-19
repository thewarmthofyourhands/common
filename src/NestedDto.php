<?php

declare(strict_types=1);

namespace Eva\Common;

use ReflectionClass;

class NestedDto
{
    public function __construct(CollectionInterface|array $data)
    {
        $ref = new ReflectionClass($this);

        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                if (is_array($value) && is_subclass_of($ref->getProperty($property)->getType()->getName(), NestedDto::class)) {
                    $this->$property = new ($ref->getProperty($property)->getType()->getName())($value);
                } else {
                    $this->$property = $value;
                }
            }
        }
    }

    public function toArray(): array
    {
        $ref = new ReflectionClass($this);
        $vars = get_object_vars($this);

        foreach ($vars as $property => $var) {
            if (is_object($var) && is_subclass_of($ref->getProperty($property)->getType()->getName(), NestedDto::class)) {
                $vars[$property] = $var->toArray();
            }
        }

        return $vars;
    }
}
