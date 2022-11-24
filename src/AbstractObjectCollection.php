<?php

declare(strict_types=1);

namespace Eva\Common;

use RuntimeException;

abstract class AbstractObjectCollection extends Collection
{
    /**
     * @throws RuntimeException
     */
    public function add(mixed $item, int|string|null $key = null): static
    {
        $this->validCorrectType($item);

        return parent::add($item);
    }

    /**
     * @throws RuntimeException
     */
    public function addAll(array $items): static
    {
        foreach ($items as $item) {
            $this->validCorrectType($item);
        }

        return parent::addAll($items);
    }

    /**
     * @throws RuntimeException
     */
    private function validCorrectType(mixed $item): void
    {
        $className = $this->getClassName();

        if (false === $item instanceof $className) {
            throw new RuntimeException('Wrong type of item for object collection');
        }
    }

    abstract protected function getClassName(): string;
}
