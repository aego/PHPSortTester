<?php

namespace sorts;
use SortingAlgorithm\SortingAlgorithm;

/**
 * Class SortTester
 * @package sorts
 */
class SortTester
{
    /**
     * @var bool
     */
    private $_enableOutput = true;
    /**
     * @var string
     */
    private $_outputSeparator = PHP_EOL;
    /**
     * @var int
     */
    private $_arraySizeFrom = 20000;
    /**
     * @var int
     */
    private $_arraySizeTo = 800000;
    /**
     * @var int
     */
    private $_arraySizeStep = 20000;
    /**
     * @var int
     */
    private $_iterationCount = 10;
    /**
     * @var int
     */
    private $_randomArrayElementFrom = 0;
    /**
     * @var int
     */
    private $_randomArrayElementTo = 100;
    /**
     * @var null|\SplObjectStorage
     */
    private $_sortingAlgorithms = null;
    /**
     * @var array
     */
    private $_result = array();


    public function __construct()
    {
        $this->_sortingAlgorithms = new \SplObjectStorage();
    }


    public function testAlgorithms()
    {
        foreach ($this->_sortingAlgorithms as $algorithm) {
            $this->testAlgorithm($algorithm);
        }
    }

    /**
     * @param SortingAlgorithm $algorithm
     */
    public function attachAlgorithm(SortingAlgorithm $algorithm)
    {
        $this->_sortingAlgorithms->attach($algorithm);
    }

    /**
     * @return array
     */
    public function getResult()
    {
        return $this->_result;
    }

    /**
     * @param int $size
     * @return array
     * @throws SortTesterException
     */
    private function generateArray($size)
    {
        if ( !is_int($size) ) {
            throw new SortTesterException("Can not generate array for non-integer size.");
        }

        $arrayToSort = array();

        for ($i = 0; $i < $size; $i++) {
            $element = mt_rand($this->_randomArrayElementFrom, $this->_randomArrayElementTo);
            $arrayToSort[] = $element;
        }

        return $arrayToSort;
    }

    /**
     * @param SortingAlgorithm $algorithm
     * @throws SortTesterException
     */
    private function testAlgorithm(SortingAlgorithm $algorithm)
    {
        $iterationNumber = 1;
        $algorithmName = get_class($algorithm);

        while ($iterationNumber <= $this->_iterationCount) {
            $size = $this->_arraySizeFrom;

            while ($size <= $this->_arraySizeTo) {
                $arrayToSort = $this->generateArray($size);

                $startTime = microtime(true);
                $sortedArray = $algorithm->sort($arrayToSort);
                $elapsedTime = microtime(true) - $startTime;

                //@TODO: log memory usage

                if ( $this->checkIsArraySorted($sortedArray) ) {
                    $this->storeTestResult(get_class($algorithm), $size, $elapsedTime);
                } else {
                    $this->output("Algorithm's [" . $algorithmName . "] result is not a sorted array.");
                }

                unset($arrayToSort);
                unset($sortedArray);

                $size += $this->_arraySizeStep;
            }

            $iterationNumber++;
        }
    }

    /**
     * @param string $sortClassName
     * @param int $arraySize
     * @param float $elapsedTime
     */
    private function storeTestResult($sortClassName, $arraySize, $elapsedTime)
    {
        if ( !isset($this->_result[$sortClassName]) ) {
            $this->_result[$sortClassName] = array();
        }

        if ( !isset($this->_result[$sortClassName][$arraySize]) ) {
            $this->_result[$sortClassName][$arraySize] = array();
        }

        $this->_result[$sortClassName][$arraySize][] = $elapsedTime;
    }

    /**
     * @param array $array
     * @return bool
     */
    private function checkIsArraySorted(array $array)
    {
        $out = true;
        $lastElement = null;

        foreach ($array as $arrayElement) {
            if ( !is_null($lastElement) ) {
                if ( $lastElement > $arrayElement ) {
                    $out = false;
                    break;
                }
            }

            $lastElement = $arrayElement;
        }

        return $out;
    }

    /**
     * @param $string
     */
    private function output($string)
    {
        if ( $this->_enableOutput === true ) {
            echo $string . $this->_outputSeparator;
        }
    }
}

/**
 * Class SortTesterException
 * @package sorts
 */
class SortTesterException extends \Exception
{

}

/* EOF */