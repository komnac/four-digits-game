<?php

namespace My\App\Helpers;

/**
 * Class Request
 *
 * Base class for implement properties that needed for work.
 */
class StrongAccessor
{
    const SET_UNEXISTS_VALUE = 'Попытка установить не сущесвующий свойство %s';
    const GET_UNEXISTS_VALUE = 'Попытка получить доступ к несуществующему свойству %s';
    const GET_NONSETUPED_VALUE = 'Попытка получить доступ к неустановленному свойству %s';

    public function __set($name, $value)
    {
        if (!property_exists($this, $name)) {
            throw new \RuntimeException(
                sprintf(
                    self::SET_UNEXISTS_VALUE,
                    $name
                )
            );
        }

        $this->$name = $value;
    }

    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            throw new \RuntimeException(
                sprintf(
                    self::GET_UNEXISTS_VALUE,
                    $name
                )
            );
        }

        if (is_null($this->$name)) {
            throw new \RuntimeException(
                sprintf(
                    self::GET_NONSETUPED_VALUE,
                    $name
                )
            );
        }

        return $this->$name;
    }

    /**
     * Safe get property.
     *
     * @param $name           name of property
     * @param string $type    type of getting data (this type will be casting returned value)
     * @param mixed $altValue if property does not exists or it's value is null return this value
     *
     * @return mixed
     */
    public function getVar($name, $type = 'raw', $altValue = '')
    {
        if (!property_exists($this, $name) || is_null($this->$name)) {
            return $altValue;
        }

        $value = $this->$name;
        switch ($type) {
            case 'int':
                $value = (int) $value;
                break;
        }

        return $value;
    }
}
