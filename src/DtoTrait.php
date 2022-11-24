<?php

declare(strict_types=1);

namespace Eva\Common;

trait DtoTrait
{
    public function __construct(CollectionInterface|array $data)
    {
        array_walk($data, function (mixed $value, string $property): void {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        });
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
