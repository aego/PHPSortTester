<?php

namespace SortingAlgorithm;

/**
 * Class StandardSort
 * @package SortingAlgorithm
 */
class StandardSort implements SortingAlgorithm
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array)
    {
        sort($array);

        return $array;
    }
}

/* EOF */