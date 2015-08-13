<?php

namespace My\FourDigits;

class CompareResult
{
    const DIGIT_COWS_AND_BULLS = "%s: быков %u, коров %u";

    protected $cows = 0;
    protected $bulls = 0;
    protected $errors = [];

    private $compareNumber;
    private $questNumber;

    /**
     * @param Number $questNumber
     * @param int|string $compareNumber
     */
    public function __construct(Number $questNumber, $compareNumber)
    {
        $this->questNumber = $questNumber;
        $this->compareNumber = $this->prepareNumber($compareNumber);

        $this->compare();
    }

    /**
     * Return an error messages when compare.
     *
     * @return string
     */
    public function getErrors()
    {
        return implode("\n", $this->errors);
    }

    /**
     * Detect if comparing has one or more error.
     *
     * @return bool TRUE if compare has some errors; FALSE otherwise
     */
    public function hasError()
    {
        return !empty($this->errors);
    }

    /**
     * Return a number of bulls.
     *
     * @return int
     */
    public function getBulls()
    {
        return $this->bulls;
    }

    /**
     * Return a number of cows.
     *
     * @return int
     */
    public function getCows()
    {
        return $this->cows;
    }

    public function __toString()
    {
        return sprintf(
            self::DIGIT_COWS_AND_BULLS,
            $this->compareNumber,
            $this->getBulls(),
            $this->getCows()
        );
    }

    private function prepareNumber($number)
    {
        $num = (string) (int) $number;
        if ($number != $num) {
            $this->errors[] = sprintf(Error::NUMBER_HAS_SYMBOLS, $number);
        }

        if (strlen($num) !== 4) {
            $this->errors[] = sprintf(Error::NUMBER_IS_NOT_4DIGITS, $num);
            $num = substr($num, 0, 4);
        }

        $num = str_split($num);
        if (4 === count(array_unique($num))) {
            $this->errors[] = sprintf(Error::NUMBER_DIGITS_NOT_UNIQ);

        }

        return $num;
    }

    private function compare()
    {
        $questNumber = $this->questNumber->asArray();
        foreach ($this->compareNumber as $digitPosition => $digit) {
            if (in_array($digit, $questNumber)) {
                if ($questNumber[$digitPosition] == $digit) {
                    $this->bulls++;
                } else {
                    $this->cows++;
                }
            }
        }
    }
}
