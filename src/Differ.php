<?php

namespace Differ\Differ;

function genDiff(array $pathToFile1, array $pathToFile2): string
{
    $decode1 = json_decode($pathToFile1, true);
    $decode2 = json_decode($pathToFile2, true);

    $keys = array_merge(array_keys($pathToFile1), array_keys($pathToFile2));
    sort($keys);
    $result = [];


    }
}