<?php

use Illuminate\Support\Collection;

require_once(__DIR__ . '/../bootstrap.php');
require_once('reduce.php');

// Implement filter in terms of reduce.
function filter($items, $func)
{
    return reduce($items, function ($result, $item) use ($func) {
        if ($func($item)) {
            $result[] = $item;
        }

        return $result;
    }, []);
}

dump(
    filter(new Collection([1, 2, 3, 4]), function ($item) {
        return $item % 2 === 0;
    })
);