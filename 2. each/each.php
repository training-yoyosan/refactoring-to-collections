<?php

namespace higherorder;

function each($items, $func)
{
    foreach ($items as $item) {
        $func($item);
    }
}