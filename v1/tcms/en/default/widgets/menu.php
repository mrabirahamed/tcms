<?php

class menuWidget extends Widget {

    private $menu;
    public function __construct() {
        parent::__construct();
        $this->menu = $this->loadModel('menu');
    }

    public function getMenu($menu, $view, $inverse = null, $siteInfo = null) {
        $data['menu'] = $this->menu->getMenu($menu);
        $data['inverse'] = $inverse;
        $data['siteInfo'] = $siteInfo;
        $data['siteInfo'] = $this->menu->getSiteInfo();
        return $this->render($view, $data);
    }

    public function getConfig($menu) {
        $menus['header'] = array(
            'position' => 'header',
            'show' => 'all',
            'hide' => array('Login', 'Register', 'Password recovery', 'default_home')
        );
        $menus['left'] = array(
            'position' => 'left',
            'show' => 'all',
            'hide' => array('Login', 'Register', 'Password recovery', 'My home')
        );
        $menus['right'] = array(
            'position' => 'right',
            'show' => 'all',
            'hide' => array('Login', 'Register', 'Password recovery')
        );
        $menus['footer'] = array(
            'position' => 'footer',
            'show' => 'all',
            'hide' => array('Login', 'Register', 'Password recovery')
        );

        return $menus[$menu];
    }
}
