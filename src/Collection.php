<?php

declare(strict_types=1);

namespace Eva\Common;

use JsonException;

use function Eva\Common\Functions\json_encode;

class Collection implements CollectionInterface
{
    protected array $collection = [];

    public function __construct(array $collection)
    {
        $this->addAll($collection);
    }

    public function add(mixed $item, int|string|null $key = null): static
    {
        $key !== null ? $this->collection[$key] = $item : $this->collection[] = $item;

        return $this;
    }

    public function addAll(array $items): static
    {
        $this->collection = $items;

        return $this;
    }

    public function get(Callable|int|string $criterion): mixed
    {
        if (is_callable($criterion)) {
            foreach($this->collection as $key => $item) {
                $found = $key($item, $key, $this->collection);
                if ($found === true) {
                    return $item;
                }
            }

            return null;
        }

        return $this->collection[$criterion];
    }

    public function queryOne(Callable $fn): mixed
    {
        foreach ($this->collection as $key => $item) {
            $found = $fn($item, $key, $this->collection);

            if ($found === true) {
                return $item;
            }
        }

        return null;
    }

    public function query(Callable $fn): static
    {
        return new static(array_filter($this->collection, $fn, ARRAY_FILTER_USE_BOTH));
    }

    public function map(callable $fn): static
    {
        return new static(array_map($fn, $this->collection));
    }

    public function forEach(callable $fn): static
    {
        foreach ($this->collection as $key => $item) {
            $fn($item, $key, $this->collection);
        }

        return $this;
    }

    public function filter(callable $fn, ?int $mode = null): static
    {
        $this->collection = array_filter($this->collection, $fn, $mode ?? ARRAY_FILTER_USE_BOTH);

        return $this;
    }

    public function values(): array
    {
        return array_values($this->collection);
    }

    public function isEmpty(): bool
    {
        return $this->collection === [];
    }

    public function unset(int|string $key): void
    {
        unset($this->collection[$key]);
    }

    public function clear(): void
    {
        $this->collection = [];
    }

    public function count(): int
    {
        return count($this->collection);
    }

    public function toArray(): array
    {
        return $this->collection;
    }

    /**
     * @throws JsonException
     */
    public function jsonSerialize(): string
    {
        return json_encode($this->toArray());
    }

    public function current(): mixed
    {
        return current($this->collection);
    }

    public function next(): void
    {
        next($this->collection);
    }

    public function end(): void
    {
        end($this->collection);
    }

    public function prev(): mixed
    {
        prev($this->collection);
    }

    public function reset(): mixed
    {
        return reset($this->collection);
    }

    public function key(): string|int|null
    {
        return key($this->collection);
    }

    public function valid(): bool
    {
        return isset($this->collection[$this->key()]);
    }

    public function rewind(): void
    {
        reset($this->collection);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->collection[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->collection[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->add($value, $offset);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->unset($offset);
    }
}
