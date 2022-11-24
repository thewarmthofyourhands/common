<?php

declare(strict_types=1);

namespace Eva\Common;

class ObjectCollection extends AbstractObjectCollection
{
    public function __construct(protected readonly string $className, array $collection)
    {
        parent::__construct($collection);
    }

    protected function getClassName(): string
    {
        return $this->className;
    }

    public function toArray(): array
    {
        if (is_subclass_of($this->getClassName(), ToArrayInterface::class)) {
            $list = [];

            foreach ($this->collection as $key => $item) {
                $list[$key] = $item->toArray();
            }

            return $list;
        }

        return $this->collection;
    }
}
