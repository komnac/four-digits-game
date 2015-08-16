<?php

namespace My\Game;

class Error extends \Exception
{
    const WORD_IS_EMPTY = 'Загаданное значение не может быть пустым!';
    const QUIZ_WORD_NOT_UNIQ = 'Загаданное значение "%s" не уникально!';
}
