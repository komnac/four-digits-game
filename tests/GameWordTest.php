<?php

use My\Game\Word;

class GameWordTest extends PHPUnit_Framework_TestCase
{
    public function dataWordAsChars()
    {
        return [
            [ 1234, [1, 2, 3, 4]],
            [ 'hello', ['h', 'e', 'l', 'l', 'o']],
            [ '013hi', [ 0, 1, 3, 'h', 'i']]
        ];
    }

    public function dataWordAsString()
    {
        return [
            [ 1234, '1234'],
            [ 'hello', 'hello'],
            [ '12h45', '12h45']
        ];
    }

    public function dataWordIsUniq()
    {
        return [
            [ '123', true],
            [ 'heh', false],
            [ 'hello', false],
            [ 'world', true]
        ];
    }

    public function dataWordLength()
    {
        return [
            [ 'hi', 2],
            [ 'hello', 5],
            [ 'this_is_long_string', 19]
        ];
    }

    /**
     * @expectedException My\Game\Error
     */
    public function testEmptyWord()
    {
        new Word("");
    }

    /**
     * @dataProvider dataWordAsChars
     */
    public function testWordGetChars($word, $expected)
    {
        $w = new Word($word);

        $this->assertEquals(
            $expected,
            $w->getChars()
        );
    }

    /**
     * @dataProvider dataWordAsString
     */
    public function testWordAsString($word, $expected)
    {
        $w = new Word($word);

        $this->assertEquals(
            $expected,
            (string) $w
        );
    }

    /**
     * @dataProvider dataWordLength
     */
    public function testWordLength($word, $expected)
    {
        $w = new Word($word);

        $this->assertEquals(
            $expected,
            $w->getLength()
        );
    }

    /**
     * @dataProvider dataWordIsUniq
     */
    public function testWordIsCharsUniq($word, $expected)
    {
        $w = new Word($word);

        $this->assertEquals(
            $expected,
            $w->isCharsUniq()
        );
    }

    public function testWordTruncate()
    {
        $w = new Word('hello_world');
        $w->truncate(5);
        $this->assertEquals('hello', (string) $w);

        $w->truncate(100);
        $this->assertEquals('hello', (string) $w);

        $w->truncate(3);
        $this->assertEquals('hel', (string) $w);
    }
}
