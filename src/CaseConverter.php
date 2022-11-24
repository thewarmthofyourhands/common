<?php

declare(strict_types=1);

namespace Eva\Common;

class CaseConverter
{
    public static function toCamelCase(string $string): string
    {
        return str_replace(['_', '-'], '', lcfirst(ucwords($string, '_-')));
    }

    public static function toPascaleCase(string $string): string
    {
        return str_replace(['_', '-'], '', ucwords($string, '_-'));
    }

    public static function toSnakeCase($input): string
    {
        $pattern = '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!';
        preg_match_all($pattern, $input, $matches);
        $ret = $matches[0];

        foreach ($ret as &$match) {
            $match = $match === strtoupper($match) ?
                strtolower($match) :
                lcfirst($match);
        }

        return implode('_', $ret);
    }
}
