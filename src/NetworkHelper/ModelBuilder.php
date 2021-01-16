<?php


namespace App\NetworkHelper;


class ModelBuilder
{
    public function convert($class, array $arrayData)
    {
        $object = new $class();
        foreach ($arrayData as $key => $value)
        {

            $funcName = 'set' . ucwords($key);
            if(method_exists($object, $funcName)) $object->$funcName($value);

            //$object->__set($key, $value);
        }

        return $object;
    }
}