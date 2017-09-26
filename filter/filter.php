<?php

function filter($items, $func)
{
    $results = [];

    if ($func($item)) {
        $results[] = $item;
    }

    return $results;
}

// Reject = Negate filter
function reject($items, $func)
{
    return filter($items, function ($item) use ($func) {
        return ! $func($item);
    });
}