<?php

namespace Differ\Differ;

function genDiff(string $pathToFile1, string $pathToFile2): string
{
    $pathToFile1 = realpath($pathToFile1);
    $pathToFile2 = realpath($pathToFile2);

    // Чтение содержимого файлов JSON и преобразование их в массивы
    $content1 = file_get_contents($pathToFile1);
    $content2 = file_get_contents($pathToFile2);

    $data1 = json_decode($content1, true);
    $data2 = json_decode($content2, true);

    // Сравнение массивов и формирование результата
    $result = [];
    $keys = array_unique(array_merge(array_keys($data1), array_keys($data2)));
    sort($keys);

    foreach ($keys as $key) {
        if (!array_key_exists($key, $data1)) {
            $result[] = "+ {$key}: {$data2[$key]}";
        } elseif (!array_key_exists($key, $data2)) {
            $result[] = "- {$key}: {$data1[$key]}";
        } elseif ($data1[$key] !== $data2[$key]) {
            $result[] = "- {$key}: {$data1[$key]}";
            $result[] = "+ {$key}: {$data2[$key]}";
        }
    }

    // Сортировка результатов по алфавиту
    sort($result);

    // Возврат результата в виде строки
    return implode("\n", $result);
}

