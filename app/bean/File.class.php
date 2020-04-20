<?php

class File{
    private $name;
    private $isDir;
    function __construct($name,$isDir){
        $this->$name=$name;
        $this->isDir=$isDir;
    }
    function __toString(){
        // TODO: Implement __toString() method.
        return '{name:"'+$this->name+'",isDir:"'+$this->isDir+'"}';
    }

    /**
     * @return mixed
     */
    public function getIsDir(){
        return $this->isDir;
    }
    /**
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @param mixed $isDir
     */
    public function setIsDir($isDir){
        $this->isDir = $isDir;
    }
    /**
     * @param mixed $name
     */
    public function setName($name){
        $this->name = $name;
    }
}