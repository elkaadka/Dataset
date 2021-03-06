<?php

namespace Zeeml\DataSet\Tests\Processor;

use PHPUnit\Framework\TestCase;
use Zeeml\DataSet\Processor\ArrayProcessor;

class ArrayProcessorTest extends TestCase
{
    /**
     * @dataProvider getData
     * @param $dataSource
     * @param $expectedDataSet
     */
    public function test_read(array $dataSource, array $expectedDataSet)
    {
        $processor = new ArrayProcessor($dataSource);
        $data = $processor->read();

        $this->assertEquals($expectedDataSet, $data);
    }

    public function getData()
    {
        return [
            [
                [
                    [1, 2, 3],
                    [4, 5, 6],
                    [7, 8, 9],
                ],
                [
                    [1, 2, 3],
                    [4, 5, 6],
                    [7, 8, 9],
                ]
            ],
            [
                [
                    [[1], 2, 3],
                    [4, [5], 6],
                    [7, 8, [9]],
                ],
                []
            ],
            [
                [
                    [ 'hello', 'this' ],
                    [ 'is', 'my' ],
                    [ new class(){}, [3] ],
                ],
                [
                    [ 'hello', 'this' ],
                    [ 'is', 'my' ],
                ]
            ],
            [
                [
                    [ ['hello'], ['these'] ],
                    [ 'are', 'not' ],
                    [ [new class(){}], ['numeric'] ],
                ],
                [
                    [ 'are', 'not' ]
                ]
            ],
        ];
    }
}
