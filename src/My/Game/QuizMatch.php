<?php

namespace My\Game;

class QuizMatch {
    private $quest;
    private $answer;

    private $bulls = 0;
    private $cows  = 0;

    public function __construct(Quiz $quiz, Word $answer)
    {
        $this->quest  = $quiz->getQuestWord();
        $this->answer = $answer->truncate($this->quest->getLength());

        $this->doMatch();
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

    /*
     * Return an answer string.
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    public function __toString()
    {
        if ($this->isFullMatched()) {
            return sprintf('%s', $this->getAnswer());
        }

        return sprintf(
            '%s: %s, %s',
            $this->getAnswer(),
            $this->digitString(
                $this->getBulls(),
                'бык',
                'быка',
                'быков'
            ),
            $this->digitString(
                $this->getCows(),
                'корова',
                'коровы',
                'коров'
            )
        );
    }

    /**
     * Return a full answer quiz status.
     *
     * @return bool TRUE when quiz completely matched; FALSE otherwise
     */
    public function isFullMatched()
    {
        return $this->getBulls() === $this->quest->getLength();
    }

    private function doMatch()
    {
        $quest = $this->quest->getChars();
        $match = $this->answer->getChars();

        foreach ($match as $charPosition => $char) {
            if (in_array($char, $quest)) {
                if ($quest[$charPosition] == $char) {
                    $this->bulls++;
                } else {
                    $this->cows++;
                }
            }
        }
    }

    private function digitString($number, $isOne, $isTwoThreeFour, $default)
    {
        $lastDigit = substr($number, -1);
        if ($lastDigit > 0 && $lastDigit < 5) {
            $last2Digits = substr($number, -2);
            if ($last2Digits > 20 || $last2Digits < 10 ) {
                if ($lastDigit == 1) {
                    return sprintf('%u %s', $number, $isOne);
                } else {
                    return sprintf('%u %s', $number, $isTwoThreeFour);
                }
            }
        }

        return sprintf('%u %s', $number, $default);
    }
}
