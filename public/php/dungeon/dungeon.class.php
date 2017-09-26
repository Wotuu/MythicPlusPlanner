<?php

require_once("arcway.class.php");

/**
 * Created by PhpStorm.
 * User: Wouter
 * Date: 22/07/2017
 * Time: 15:35
 */
class Dungeon
{
    private $_name;
    private $_floorCount;
    private $_filePath;

    function __construct($name, $floorCount, $file)
    {
        assert(is_string($name));
        assert(is_int($floorCount));
        assert(is_string($file));

        $this->_name = $name;
        $this->_floorCount = $floorCount;
        $this->_filePath = $file;
    }

    function getName()
    {
        return $this->_name;
    }

    function getFloorCount(){
        return $this->_floorCount;
    }

    function getFilePath()
    {
        return $this->_filePath;
    }

    function getKey(){
        $explode = explode(DIRECTORY_SEPARATOR, $this->_filePath);

        return $explode[count($explode) - 1];
    }
}