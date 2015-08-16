<?php

use My\Game\Quiz;

class GameQuizTest extends PHPUnit_Framework_TestCase
{

    public function dataQuizTestSamples()
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
            [ 9876, 6789, [ 0, 4 ] ],
            [ '0216', '0216', [ 4, 0 ] ]
        ];
    }

    /**
     * @dataProvider dataQuizTestSamples
     */
    public function testQuizResults($quest, $match, $expected)
    {
        $quiz = new Quiz($quest);
        $quizMatch = $quiz->match($match);

        $this->assertEquals(
            $expected,
            [
                $quizMatch->getBulls(),
                $quizMatch->getCows()
            ]
        );
    }

    /**
     * @expectedException My\Game\Error
     */
    public function testNonUniqWordInQuiz()
    {
        new Quiz('hello');
    }
}
