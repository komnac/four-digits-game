<?php

namespace My\App\Database;

class Exception extends \Exception
{
    const WRONG_QUERY  = "Ошибка выполнения запроса [%s]: %s";
    const NO_DB_CONNECTION = "Ошибка подключения к БД %s: %s";
}
