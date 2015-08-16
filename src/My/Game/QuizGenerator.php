<?php

namespace My\Game;


abstract class QuizGenerator {

    /**
     * Return a size of word.
     *
     * @return int
     */
    abstract public function getSize();

    /**
     * Return an alphabet for quiz.
     *
     * @return string
     */
    abstract public function getAlphabet();

    /**
     * @return Quiz
     */
    final public function generate()
    {
        $shuffle = str_shuffle($this->getAlphabet());

        $word = substr(
            $shuffle,
            ($shuffle[0] === 0) ? 1 : 0,
            $this->getSize()
        );

        return new Quiz($word);
    }

    /**
     * Return a Quiz by given word.
     *
     * @param int|string|Word $word
     *
     * @return Quiz
     */
    static public function getQuiz($word)
    {
        return new Quiz($word);
    }
}
