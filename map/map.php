<?php

function map($items, $func)
{
    $results = [];

    foreach ($items as $item) {
        $results[] = $funct($item);
    }

    return $results;
}