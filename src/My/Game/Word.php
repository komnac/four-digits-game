<?php

namespace My\Game;

/**
 * Class Word
 *
 * @todo this class didn't work in multibyte string
 */
class Word
{
    /**
     * @var string
     */
    private $word;

    /**
     * Create a new word.
     *
     * @param int|string $word
     */
    public function __construct($word)
    {
        if (!$word) {
            throw new Error(Error::WORD_IS_EMPTY);
        }
        $this->word = (string) $word;
    }

    public function __toString()
    {
        return $this->word;
    }

    /**
     * Return an array of chars.
     *
     * @return array order list of chars
     */
    public function getChars()
    {
        return str_split($this->word);
    }

    /**
     * Return a length of word.
     *
     * @return int length of number
     */
    public function getLength()
    {
        return strlen($this->word);
    }

    /**
     * Validate if current word has only uniq symbols.
     *
     * @return bool TRUE if has has only non-duplicated digits; FALSE otherwise
     */
    public function isCharsUniq()
    {
        return $this->getLength() === count(array_unique($this->getChars()));
    }

    /**
     * Truncate a current word for specified length.
     *
     * @param int $length
     *
     * @return $this
     */
    public function truncate($length)
    {
        $this->word = substr($this->word, 0, $length);

        return $this;
    }
}
