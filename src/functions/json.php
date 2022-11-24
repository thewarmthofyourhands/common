<?php

declare(strict_types=1);

namespace Eva\Common\Functions;

use JsonException;

/**
 * @throws JsonException
 */
function json_encode(mixed $value, int $flags = 0, int $depth = 512): string
{
    $res = \json_encode($value, $flags|JSON_THROW_ON_ERROR, $depth);

    if ($res === false) {
        throw new JsonException(json_last_error_msg());
    }

    return $res;
}

/**
 * @throws JsonException
 */
function json_decode(string $json, ?bool $associative = null, int $depth = 512, int $flags = 0): mixed
{
    $res = \json_decode($json, $associative, $depth, $flags|JSON_THROW_ON_ERROR);

    if ($res === null) {
        throw new JsonException(json_last_error_msg());
    }

    return $res;
}
