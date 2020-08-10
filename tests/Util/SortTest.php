<?php

namespace App\Tests\Util;

use App\Util\Sort;
use PHPUnit\Framework\TestCase;

class SortTest extends TestCase
{    
    /**
     * testBubbleSort
     *
     * @return void
     */
    public function testBubbleSort()
    {
        $array = [90, 5, 2, 6, 1];
        $sort = new Sort();
        $result = $sort->BubbleSort($array);
        $this->assertEquals([1, 2, 5, 6, 90], $result);
    }
}
