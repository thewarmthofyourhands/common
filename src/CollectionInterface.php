<?php

declare(strict_types=1);

namespace Eva\Common;

use ArrayAccess;
use Iterator;
use Countable;
use JsonSerializable;

interface CollectionInterface extends ArrayAccess, JsonSerializable, Iterator, Countable, ToArrayInterface
{
    public function add(mixed $item, null|int|string $key): static;
    public function addAll(array $items): static;

    public function get(Callable|int|string $criterion): mixed;
    public function queryOne(Callable $fn): mixed;
    public function query(Callable $fn): static;
    public function map(Callable $fn): static;

    public function filter(Callable $fn, null|int $mode = null): static;

    public function forEach(Callable $fn): static;

    public function values(): array;
    public function isEmpty(): bool;
    public function unset(string|int $key): void;
    public function clear(): void;

    public function end(): void;
    public function prev(): mixed;
    public function reset(): mixed;
}
