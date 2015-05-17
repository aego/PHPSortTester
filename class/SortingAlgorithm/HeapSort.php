<?php

namespace SortingAlgorithm;

/**
 * Class HeapSort
 * @package SortingAlgorithm
 */
class HeapSort implements SortingAlgorithm
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array)
    {
        $arraySize = sizeof($array) - 1;
        $this->buildHead($array, $arraySize);

        while ($arraySize > 0) {
            $this->swap($array, 0, $arraySize);
            $this->heapify($array, $arraySize, 0);
            $arraySize--;
        }

        return $array;
    }

    /**
     * @param array $array
     * @param int $heapSize
     */
    private function buildHead(array &$array, $heapSize)
    {
        for ($i = round($heapSize / 2); $i >= 0; $i--) {
            $this->heapify($array, $heapSize, $i);
        }
    }

    /**
     * @param array $array
     * @param int $length
     * @param int $i
     */
    private function heapify(array &$array, $length, $i)
    {
        $left = $this->left($i);
        $right = $this->right($i);
        $largest = $i;

        if ( $left < $length && $array[$i] < $array[$left] ) {
            $largest = $left;
        }

        if ($right < $length && $array[$largest] < $array[$right]) {
            $largest = $right;
        }

        if ( $i != $largest ) {
            $this->swap($array, $i, $largest);
            $this->heapify($array, $length, $largest);
        }
    }

    /**
     * @param int $i
     * @return int
     */
    private function right($i)
    {
        return 2 * $i + 1;
    }

    /**
     * @param int $i
     * @return int
     */
    private function left($i)
    {
        return 2 * $i + 2;
    }

    /**
     * @param array $array
     * @param int $first
     * @param int $second
     */
    private function swap(array &$array, $first, $second)
    {
        $temp = $array[$first];
        $array[$first] = $array[$second];
        $array[$second] = $temp;
        unset($temp);
    }
}

/* EOF */