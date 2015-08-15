<?php

namespace My\Game;

class Quiz {
    private $quest;

    public function __construct($word)
    {
        $quest = ($word instanceof Word) ? $word : new Word($word);

        if (!$quest->isCharsUniq()) {
            throw new Error(
                sprintf(Error::QUIZ_WORD_NOT_UNIQ, $word)
            );
        }

        $this->quest = $quest;
    }

    /**
     * Return a question word.
     *
     * @return Word
     */
    public function getQuestWord()
    {
        return $this->quest;
    }

    /**
     * Match this quiz with a specified word.
     *
     * @param string|int $word  matching word
     *
     * @return QuizMatch
     */
    public function match($word)
    {
        $match = ($word instanceof Word) ? $word : new Word($word);

        return new QuizMatch($this, $match);
    }
}
