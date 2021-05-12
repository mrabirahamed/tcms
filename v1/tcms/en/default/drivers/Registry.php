<?php

class Registry
{
    private static $instance;
    private $data;

    /*Instancer Class*/
    private function __construct(){}

        /*Selection*/
    public static function getInstance(){
        if(!self::$instance instanceof self){
            self::$instance = new Registry();
        }

        return self::$instance;
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __get($name) {
        if(isset($this->data[$name])){
            return $this->data[$name];
        }
        return false;
    }
}
