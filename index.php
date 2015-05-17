<?php

namespace sorts;

use SortingAlgorithm\BubbleSort;
use SortingAlgorithm\HeapSort;
use SortingAlgorithm\HeapSortWithSplHeap;
use SortingAlgorithm\MergeSort;
use SortingAlgorithm\QuickSortWithAveragePivot;
use SortingAlgorithm\QuickSortWithMiddlePivot;
use SortingAlgorithm\RadixSort;
use SortingAlgorithm\StandardSort;
use SortingAlgorithm\StandardSortArrayObject;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . DS . 'projects' . DS . 'sorts');

try {
    spl_autoload_register(__NAMESPACE__ . '\\myLoad');

    $tester = new SortTester();
    $tester->attachAlgorithm(new StandardSort());
    $tester->attachAlgorithm(new StandardSortArrayObject());
    $tester->attachAlgorithm(new RadixSort());
    $tester->attachAlgorithm(new MergeSort());
    $tester->attachAlgorithm(new BubbleSort());
    $tester->attachAlgorithm(new HeapSort());
    $tester->attachAlgorithm(new HeapSortWithSplHeap());
    $tester->attachAlgorithm(new QuickSortWithMiddlePivot());
    $tester->attachAlgorithm(new QuickSortWithAveragePivot());
    $tester->testAlgorithms();

    saveResult($tester->getResult());

} catch (\Exception $e) {
    var_dump($e);
    die();
}


/**
 * @param string $className
 */
function myLoad($className)
{
    if ( strlen($className) > 0 ) {
        $className = str_replace(__NAMESPACE__ . "\\", '', $className);
        $path = str_replace('_', DS, $className);
        $path = str_replace('\\', DS, $path);
        $filePath = ROOT . DS . 'class'. DS . $path;
        $fileName = $filePath . '.php';

        if ( file_exists($fileName) ) {
            require_once($fileName);
        }
    }
}

/**
 * @param array $results
 */
function saveResult(array $results)
{
    $fileName = time() . '_results.csv';

    $file = new \SplFileObject(ROOT . DS . $fileName, 'x');

    foreach ($results as $algName => $algData) {
        $algName = str_replace("SortingAlgorithm\\", "", $algName);

        foreach ($algData as $elementCount => $iterations) {
            $avg = array_sum($iterations) / sizeof($iterations);

            $file->fwrite("$algName;$elementCount;$avg\n");
        };
    }
}



/* EOF */