<?php

namespace SortingAlgorithm;

/**
 * Class StandardSortArrayObject
 * @package SortingAlgorithm
 */
class StandardSortArrayObject implements SortingAlgorithm
{
    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array)
    {
        $object = new \ArrayObject($array);
        $object->asort();
        $result = $object->getArrayCopy();
        unset($object);

        return $result;
    }
}

/* EOF */