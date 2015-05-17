<?php

namespace SortingAlgorithm;

/**
 * Class MergeSort
 * @package SortingAlgorithm
 */
class MergeSort implements SortingAlgorithm
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array)
    {
        if ( sizeof($array) <= 1 ) {
            return $array;
        }

        $arraySize = sizeof($array);
        $middle = round($arraySize / 2, 0);

        $chunks = array_chunk($array, $middle, true);

        $sorted1 = $this->sort($chunks[0]);
        $sorted2 = $this->sort($chunks[1]);

        return $this->merge($sorted1, $sorted2);
    }

    /**
     * @param array $array1
     * @param array $array2
     * @return array
     */
    private function merge(array $array1, array $array2)
    {
        $out = array();

        while ( sizeof($array1) > 0 || sizeof($array2) > 0 ) {
            if ( sizeof($array1) > 0 && sizeof($array2) > 0 ) {
                $first = current($array1);
                $second = current($array2);

                if ( $first <= $second ) {
                    $out[] = array_shift($array1);
                } else {
                    $out[] = array_shift($array2);
                }
            } elseif ( sizeof($array1) > 0 ) {
                $out[] = array_shift($array1);
            } else {
                $out[] = array_shift($array2);
            }
        }

        return $out;
    }
}

/* EOF */