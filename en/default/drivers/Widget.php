<?php

abstract class Widget
{

    private $registry;
    protected $acl;

    public function __construct()
    {
        $this->registry = Registry::getInstance();
        $this->acl = $this->registry->acl;
    }

    protected function loadModel($model)
    {
        if (is_readable(WidgetsDIR . 'models' . DS . $model . '.php')) {
            require_once WidgetsDIR . 'models' . DS . $model . '.php';

            $modelClass = $model . 'ModelWidget';

            if (class_exists($modelClass)) {
                return new $modelClass;
            }
        }

        Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Model class not found or Model class loading error.')));
        throw new Exception('Model class not found or Model class loading error.');
    }

    protected function render($view, $data = array(), $ext = '.phtml')
    {
        if (is_readable(WidgetsDIR . 'views' . DS . $view . $ext)) {
            ob_start();
            extract($data);
            include_once WidgetsDIR . 'views' . DS . $view . $ext;
            $content = ob_get_contents();
            ob_end_clean();
            return $content;
        }

        Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Widget\'s views content not found.')));
        throw new Exception('Widget\'s views content not found.');
    }
}