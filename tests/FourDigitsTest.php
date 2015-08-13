<?php

use My\FourDigits\Number;

class FourDigitsTest extends PHPUnit_Framework_TestCase
{
    public function testNumberValidator()
    {
        $map = [
            '1234' => true,
            '12234' => false,
            '1111' => false,
            'qu8s' => false,
            '123456' => false,
            '5649a' => false
        ];

        foreach ($map as $num => $valid) {
            $this->assertEquals($valid, Number::isValid($num));
        }
    }

    /**
     * @expectedException My\FourDigits\Error
     */
    public function testErrorNumber()
    {
        $number = new Number('12355');

        return $number;
    }

    public function testNumberAsString()
    {
        $number = new Number(1234);
        $this->assertEquals('1234', (string) $number);

        $number = new Number('4567');
        $this->assertEquals('4567', (string) $number);
    }

    public function testNumberAsArray()
    {
        $number = new Number(1234);
        $this->assertEquals([ 1, 2, 3, 4], $number->asArray());
    }


    /**
     * @dataProvider compareNumberProvider
     */
    public function testCompare($questNumber, $compareNumber, $expectedResult)
    {
        $number = new Number($questNumber);
        $testResult = $number->compare($compareNumber);
        $this->assertEquals(
            $expectedResult,
            [
                $testResult->getBulls(),
                $testResult->getCows()
            ]
        );
    }

    /**
     * Generate test compare data
     *
     * [ $questNumber, $compareNumber, [ $expectedBulls, $expectedCows ] ]
     */
    public function compareNumberProvider()
    {
        return [
            [ 9876, 9876, [ 4, 0 ] ],
            [ 9876, 9871, [ 3, 0 ] ],
            [ 9876, 9816, [ 3, 0 ] ],
            [ 9876, 9176, [ 3, 0 ] ],
            [ 9876, 1876, [ 3, 0 ] ],
            [ 9876, 9801, [ 2, 0 ] ],
            [ 9876, 1870, [ 2, 0 ] ],
            [ 9876, 1276, [ 2, 0 ] ],
            [ 9876, 9071, [ 2, 0 ] ],
            [ 9876, 9867, [ 2, 2 ] ],
            [ 9876, 3456, [ 1, 0 ] ],
            [ 9876, 1234, [ 0, 0 ] ],
            [ 9876, 1265, [ 0, 1 ] ],
            [ 9876, 4567, [ 0, 2 ] ],
            [ 9876, 8961, [ 0, 3 ] ],
            [ 9876, 6789, [ 0, 4 ] ]
        ];

    }

}