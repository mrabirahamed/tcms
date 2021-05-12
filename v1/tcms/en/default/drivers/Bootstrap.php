<?php

class Bootstrap {

    public static function run(Request $prediction) {
        $m = new Modules();
        $module = $prediction->getModule();
        $controller = $prediction->getController() . 'Controller';
        $method = $prediction->getMethod();
        $args = $prediction->getArgs();

        if ($module) {
            $rootModule = $m->rootModule($module);

            if (is_readable($rootModule)) {
                require_once $rootModule;
                $rootController = ModulesDIR . $module . DS . 'controllers' . DS . $controller . '.php';
            } else {
                Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => ModulesDIR . $module . DS . 'controllers' . DS . $controller . '.php' . 'not found')));
                //throw new Exception(ModulesDIR . $module . DS . 'controllers' . DS . $controller . '.php' . 'not found');
                header('location:' . BaseURL . 'error/access/404');
            }
        } else {
            $rootController = ModulesDIR . CoreApp . DS . 'controllers' . DS . $controller . '.php';
        }

        if (is_readable($rootController)) {
            require_once $rootController;
            $controller = new $controller;

            if (is_callable(array($controller, $method))) {
                $method = $prediction->getMethod();
            } else {
                $method = 'index';
            }

            if (isset($args)) {
                call_user_func_array(array($controller, $method), $args);
            } else {
                call_user_func(array($controller, $method));
            }
        } else {
            //Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => 'Content not Found.')));
            throw new Exception( '<title> Not Found: ' . $_SERVER['REQUEST_URI'] . '</title>' . '<div style="margin: 0; padding: 0;"><div style="font-size: 20px; font-weight: bold;">Content not Found.</div><p> The requested URL:  <b>' . $_SERVER['REQUEST_URI'] . '</b></p></div>');
            //header('location:' . BaseURL . 'error/access/404');
        }
    }

}
