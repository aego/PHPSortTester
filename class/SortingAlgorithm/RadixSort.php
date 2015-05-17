<?php

namespace SortingAlgorithm;

/**
 * Class RadixSort
 * @package SortingAlgorithm
 */
class RadixSort implements SortingAlgorithm
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array)
    {
        $out = array();
        $firstBucket = $this->getEmptyBucket();

        foreach ($array as $element) {
            $element = (string)$element;
            $len = strlen($element) - 1;
            $digitPosition = $len;
            $digit = $element[$digitPosition];

            $firstBucket[$digit][] = $element;
        }

        unset($array);

        $this->sortByRadix($firstBucket, $out);

        return $out;
    }

    /**
     * @param array $array
     * @param array $out
     * @param int $iteration
     */
    public function sortByRadix(array $array, array &$out, $iteration = 1)
    {
        $deeper = false;
        $result = $this->getEmptyBucket();

        foreach ($array as $stepElements) {
            foreach ($stepElements as $element) {
                $element = (string)$element;
                $len = strlen($element) - 1;
                $digitPosition = $len - $iteration;

                if ( $digitPosition >= 0 ) {
                    $digit = $element[$digitPosition];
                    $deeper = true;
                    $result[$digit][] = $element;
                } else {
                    $out[] = $element;
                }
            }
        }

        if ( $deeper === true ) {
            $this->sortByRadix($result, $out, ++$iteration);
        }
    }

    /**
     * @return array
     */
    private function getEmptyBucket()
    {
        return array_fill(0, 10, array());
    }
}

/* EOF */