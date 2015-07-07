<?php

class ArrayInsert {

    /**
     * Inserts values before specific key.
     *
     * @param array $array
     * @param sting/integer $position
     * @param array $values
     * @throws Exception
     */
    public static function insert_before(array &$array, $position, array $values)
    {
        // enforce existing position
        if (!isset($array[$position]))
        {
            throw new Exception(strtr('Array position does not exist (:1)', [':1' => $position]));
        }

        // offset
        $offset = -1;

        // loop through array
        foreach ($array as $key => $value)
        {
            // increase offset
            ++$offset;

            // break if key has been found
            if ($key == $position)
            {
                break;
            }
        }

        $array = array_slice($array, 0, $offset, TRUE) + $values + array_slice($array, $offset, NULL, TRUE);

        return $array;
    }

    /**
     * Inserts values after specific key.
     *
     * @param array $array
     * @param sting/integer $position
     * @param array $values
     * @throws Exception
     */
    public static function insert_after(array &$array, $position, array $values)
    {
        // enforce existing position
        if (!isset($array[$position]))
        {
            throw new Exception(strtr('Array position does not exist (:1)', [':1' => $position]));
        }

        // offset
        $offset = 0;

        // loop through array
        foreach ($array as $key => $value)
        {
            // increase offset
            ++$offset;

            // break if key has been found
            if ($key == $position)
            {
                break;
            }
        }

        $array = array_slice($array, 0, $offset, TRUE) + $values + array_slice($array, $offset, NULL, TRUE);

        return $array;
    }
}