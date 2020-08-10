<?php

namespace App\Util;

class Sort
{
    /**
     * BubbleSort
     * seradi Bubble sortem pole cisel
     *
     * @param  array $arr
     * @return array
     */
    public function BubbleSort($arr)
    {
        $size = count($arr) - 1;
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size - $i; $j++) {
                $k = $j + 1;
                if ($arr[$k] < $arr[$j]) {
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }
        return $arr;
    }
}
