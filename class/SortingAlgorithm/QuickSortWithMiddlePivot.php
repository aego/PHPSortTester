<?php

/**
 * Created by PhpStorm.
 * User: Aego
 * Date: 16.05.2015
 * Time: 17:21
 */

namespace SortingAlgorithm;

/**
 * Class QuickSort_WithMiddlePivot
 * @package SortingAlgorithm\QuickSort
 */
class QuickSortWithMiddlePivot extends QuickSort
{
    /**
     * @param array $array
     * @param int $left
     * @param int $right
     * @return int
     */
    protected function getPivot(array $array, $left, $right)
    {
        $index = round(($left + $right) / 2);

        return $array[$index];
    }
}

/* EOF */