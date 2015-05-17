<?php

namespace SortingAlgorithm;

/**
 * Class BubbleSort
 * @package SortingAlgorithm
 */
class BubbleSort implements SortingAlgorithm
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array)
    {
        for ($i = 0; $i < sizeof($array) - 1; $i++) {
            for ($j = 0; $j < sizeof($array) - 1; $j++) {
                if ( $array[$j] > $array[$j+1]  ) {
                    $temp = $array[$j];
                    $array[$j] = $array[$j+1];
                    $array[$j+1] = $temp;
                    unset($temp);
                }
            }
        }

        return $array;
    }
}

/* EOF */