<?php

declare(strict_types=1);

namespace Eva\Common;

use Exception;

abstract class AbstractObjectCollection extends Collection
{
//    public function __construct(private readonly string $objectClass, array $collection)
//    {
//        parent::__construct($collection);
//    }

    /**
     * @throws Exception
     */
    public function add(mixed $item, int|string|null $key = null): static
    {
        $this->validCorrectType($item);

        return parent::add($item);
    }

    /**
     * @throws Exception
     */
    public function addAll(array $items): static
    {
        foreach ($items as $item) {
            $this->validCorrectType($item);
        }

        return parent::addAll($items);
    }

    /**
     * @throws Exception
     */
    private function validCorrectType(mixed $item): void
    {
        $className = $this->getClassName();

        if (!$item instanceof $className) {
            throw new Exception('Wrong type of item for object collection');
        }
    }

    abstract protected function getClassName(): string;
}
