<?php

namespace My\FourDigits;

/**
 * Class Number
 *
 * An object presentation of 4 digit number.
 */
class Number
{
    private $number;

    /**
     * Create a new number.
     *
     * @param int|null $number a required number for game, if not specified new number will be generated
     *
     * @throws Error when specified invalid number
     */
    public function __construct($number = '')
    {
        if (is_null($number)) {
            $this->number = $this->generateNumber();
        } elseif ($this::isValid($number)) {
            $this->number = str_split((string) (int) $number);
        } else {
            throw new Error(
                sprintf(Error::INVALID_NUMBER, $number)
            );
        }
    }

    /**
     * Check that specified number is valid for game.
     *
     * @param int $number number
     *
     * @return bool TRUE if $number is valid; FALSE otherwise
     */
    public static function isValid($number)
    {
        return ($number > 999)
                && ($number < 10000)
                && 4 === count(
                            array_unique(
                                str_split(
                                    (string) $number
                                )
                            )
                        );
    }

    /**
     * Return a current number as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return implode($this->number);
    }

    /**
     * Return a current number as an array.
     *
     * @return array
     */
    public function asArray()
    {
        return $this->number;
    }

    /**
     * Compare current number with another specified number.
     *
     * @param $number
     * @return CompareResult
     */
    public function compare($number)
    {
        return new CompareResult($this, $number);
    }

    /**
     * Generate a new valid quest number
     *
     * @return array
     */
    private function generateNumber()
    {
        return str_split(
            substr(
                str_shuffle('0123456789'),
                1,
                4
            )
        );
    }
}
