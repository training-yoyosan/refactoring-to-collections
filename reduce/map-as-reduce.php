<?php

use Illuminate\Support\Collection;

require_once(__DIR__ . '/../vendor/autoload.php');
require_once('reduce.php');

// Implement map in terms of reduce
function map($items, $func)
{
    return reduce($items, function ($result, $item) use ($func) {
        $result[] = $func($item);

        return $result;
    }, []);
}

dump(
    map(new Collection([1, 2, 3, 4]), function ($item) {
        return $item * 2;
    })
);