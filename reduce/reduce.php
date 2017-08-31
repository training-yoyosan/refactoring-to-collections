<?php

function reduce($items, $callback, $initial)
{
    $accumulator = $initial;

    foreach ($items as $item) {
        $accumulator = $callback($accumulator, $item);
    }

    return $accumulator;
}