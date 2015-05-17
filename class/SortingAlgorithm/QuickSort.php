<?php

namespace SortingAlgorithm;

/**
 * Class QuickSort
 * @package SortingAlgorithm
 */
abstract class QuickSort implements SortingAlgorithm
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array)
    {
        $left = min(array_keys($array));
        $right = max(array_keys($array));

        $this->quickSort($array, $left, $right);

        return $array;
    }

    /**
     * @param array $array
     * @param int $left
     * @param int $right
     */
    public function quickSort(array &$array, $left, $right)
    {
        $startIndex = $left;
        $endIndex = $right;
        $pivot = $this->getPivot($array, $left, $right);

        while ($left < $right) {
            while ($array[$left] < $pivot) {
                $left++;
            }
            while ($array[$right] > $pivot) {
                $right--;
            }

            if ( $left <= $right ) {
                $temp = $array[$left];
                $array[$left] = $array[$right];
                $array[$right] = $temp;
                unset($temp);

                $left++;
                $right--;
            }
        }

        if ( $startIndex < $right ) {
            $this->quickSort($array, $startIndex, $right);
        }

        if ( $left < $endIndex ) {
            $this->quickSort($array, $left, $endIndex);
        }
    }

    /**
     * @param array $array
     * @param int $left
     * @param int $right
     * @return int
     */
    abstract protected function getPivot(array $array, $left, $right);
}


/* EOF */