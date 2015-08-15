<?php

namespace My\Game;


/**
 * Generate 4 digit number Quiz
 */
class FourDigitsQuizGenerator extends QuizGenerator
{
    /**
     * {@inheritdoc}
     */
    public function getSize()
    {
        return 4;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlphabet()
    {
        return '1234567890';
    }
}
