<?php

declare(strict_types=1);

namespace Eva\Common\Functions;

function dd(...$vars) {
    var_dump(...$vars);
    exit();
}
