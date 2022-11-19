<?php

declare(strict_types=1);

namespace Eva\Common;


trait DtoTrait
{
    public function __construct(CollectionInterface|array $data)
    {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        }
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
