<?php

namespace SortingAlgorithm;

/**
 * Class HeapSortWithSplHeap
 * @package SortingAlgorithm
 */
class HeapSortWithSplHeap implements SortingAlgorithm
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array)
    {
        $out = array();
        $heap = new \SplMinHeap();

        foreach ($array as $key => $arrayElement) {
            unset($array[$key]);
            $heap->insert($arrayElement);
        }

        foreach ($heap as $element) {
            $out[] = $element;
        }

        unset($heap);

        return $out;
    }
}

/* EOF */