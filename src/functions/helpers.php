<?php

declare(strict_types=1);

namespace Eva\Common\Functions;

if (false === function_exists('dd')) {
    function dd(...$vars) {
        var_dump(...$vars);
        exit();
    }
}
