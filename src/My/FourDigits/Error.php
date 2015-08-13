<?php

namespace My\FourDigits;

class Error extends \Exception
{
    const INVALID_NUMBER = 'Загаданное число "%s" не верно';
    const NUMBER_HAS_SYMBOLS = 'Число "%s" содержит не только цифры!';
    const NUMBER_IS_NOT_4DIGITS = 'Число "%s" не четырехзначное!';
    const NUMBER_DIGITS_NOT_UNIQ = 'Не все цифры в числе уникальны!';
}
