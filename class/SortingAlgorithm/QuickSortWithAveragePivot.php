<?php

namespace SortingAlgorithm;

/**
 * Class QuickSortWithAveragePivot
 * @package SortingAlgorithm\QuickSort
 */
class QuickSortWithAveragePivot extends QuickSort
{
    /**
     * @param array $array
     * @param int $left
     * @param int $right
     * @return int
     */
    protected function getPivot(array $array, $left, $right)
    {
        $sum = 0;
        $count = 0;

        for ($i = $left; $i <= $right; $i++) {
            $sum += $array[$i];
            $count++;
        }

        $out = round($sum/$count);

        return $out;
    }
}

/* EOF */