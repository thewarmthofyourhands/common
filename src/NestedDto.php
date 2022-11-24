<?php

declare(strict_types=1);

namespace Eva\Common;

use ReflectionClass;
use ReflectionException;

class NestedDto
{
    /**
     * @throws ReflectionException
     */
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

    /**
     * @throws ReflectionException
     */
    public function toArray(): array
    {
        $ref = new ReflectionClass($this);
        $variables = get_object_vars($this);

        foreach ($variables as $property => $variable) {
            if (is_object($variable) && is_subclass_of($ref->getProperty($property)->getType()?->getName(), __CLASS__)) {
                $variables[$property] = $variable->toArray();
            }
        }

        return $variables;
    }
}
