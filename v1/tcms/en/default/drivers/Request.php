<?php

class Request {

    private $modules;
    private $controller;
    private $method;
    private $arguments;
    private $module;

    public function __construct(){
        if (isset($_GET['url'])) {
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $url = array_filter($url);

            /* modules of the application */
            $modules = new Modules();
            $this->modules = $modules->getModules();
            $this->module = strtolower(array_shift($url));

            if (!$this->module) {
                $this->module = FALSE;
            } else {
                if (count($this->modules)) {
                    if (!in_array($this->module, $this->modules)) {
                        $this->controller = $this->module;
                        $this->module = FALSE;
                    } else {
                        $this->controller = strtolower(array_shift($url));

                        if (!$this->controller) {
                            $this->controller = 'index';
                        }
                    }
                } else {
                    $this->controller = $this->module;
                    $this->module = FALSE;
                }
            }

            $this->method = strtolower(array_shift($url));
            $this->arguments = $url;
        }

        if (!$this->controller) {
            $this->controller = DefaultController;
        }
        if (!$this->method) {
            $this->method = 'index';
        }
        if (!isset($this->arguments)) {
            $this->arguments = array();
        }
    }

    public function getModule(){
        return $this->module;
    }

    public function getController(){
        return $this->controller;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getArgs(){
        return $this->arguments;
    }
}
