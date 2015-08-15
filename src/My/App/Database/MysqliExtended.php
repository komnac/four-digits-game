<?php

namespace My\App\Database;

/**
 * Mysqli with changed error behaviour on a query
 *
 * May be it's seems like workaround, but this simplify my life.
 */
class MysqliExtended extends \mysqli
{
    /**
     * {@inheritdoc}
     *
     * @throws Exception when invalid query specified.
     */
    public function query($query, $resultMode = MYSQLI_STORE_RESULT)
    {
        if (!$result = parent::query($query, $resultMode)) {
            throw new Exception(
                sprintf(
                    Exception::WRONG_QUERY,
                    $query,
                    $this->error
                )
            );
        }

        return $result;
    }
}
