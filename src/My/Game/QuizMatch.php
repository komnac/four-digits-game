<?php

namespace My\Game;

class QuizMatch {
    private $quest;
    private $match;

    private $bulls = 0;
    private $cows  = 0;

    private $matchMessage = '%s: %u быков, %u коров';

    public function __construct(Quiz $quiz, Word $match)
    {
        $this->quest = $quiz->getQuestWord();
        $this->match = $match->truncate($this->quest->getLength());

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

    /**
     * Set in printf format output match string.
     *
     * @param string $message printf format message, where 1 param (%s) qiuz number, 2 - bulls, 3 - cows
     *
     * @return self
     */
    public function setOutputString($message)
    {
        $this->matchMessage = $message;

        return $this;
    }

    public function __toString()
    {
        return sprintf(
            $this->matchMessage,
            (string) $this->quest,
            $this->getBulls(),
            $this->getCows()
        );
    }

    /**
     * Return a full match quiz status.
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
        $match = $this->match->getChars();

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
}
