<?php

require_once LibraryDIR . 'smarty' . DS . 'Smarty.class.php';
require_once LibraryDIR . 'smarty' . DS . 'SmartyBC.class.php';

class View extends SmartyBC
{
    private $request;
    private $_js;
    private $acl;
    private $roots;
    private $jsPlugin;
    private $template;
    private static $item;
    private $widget;

    public function __construct(Request $prediction, Acl $acl)
    {
        parent::__construct();
        $this->request = $prediction;
        $this->_js = array();
        $this->acl = $acl;
        $this->roots = array();
        $this->jsPlugin = array();
        $this->template = DefaultLayout;
        self::$item = null;

        $module = $this->request->getModule();
        $controller = $this->request->getController();

        if ($module) {
            $this->roots['view'] = ModulesDIR . $module . DS . 'views' . DS . 'pages' . DS . $controller . DS;
            $this->roots['js'] = BaseURL . AppSET . DS . 'modules' . DS . $module . DS . 'views' . DS . 'pages' . DS . $controller . DS . 'js' . DS;
        } else {
            $this->roots['view'] = ModulesDIR . 'core' . DS . 'views' . DS . 'pages' . DS . $controller . DS;
            $this->roots['js'] = BaseURL . AppSET . DS . 'modules' . DS . 'core' . DS . 'views' . DS . 'pages' . DS . $controller . DS . 'js' . DS;
        }
    }

    public static function getViewId()
    {
        return self::$item;
    }

    public function render($view, $item = false, $nolayout = false)
    {
        if ($item) {
            self::$item = $item;
        }

        $this->template_dir = ThemesDIR . $this->template . DS;
        $this->config_dir = ThemesDIR . $this->template . DS . 'configs' . DS;
        $this->cache_dir = ROOT . 'tmp' . DS . 'cache' . DS;
        $this->compile_dir = ROOT . 'tmp' . DS . 'template' . DS;


        $favicon = WebPublicMediaLogoImagesFolder . $this->favicon();

        $js = array();

        if (count($this->_js)) {
            $js = $this->_js;
        }

        $layoutParams = array(
            'publicCSS' => BaseURL . 'public' . DS . 'css' . DS,
            'publicBootstrapCSS' => BaseURL . 'public' . DS . 'css' . DS . 'bootstrap' . DS,
            'publicFontAwesomeCSS' => BaseURL . 'public' . DS . 'css' . DS . 'font-awesome' . DS,
            'publicJqueryUICSS' => BaseURL . 'public' . DS . 'css' . DS . 'jquery-ui' . DS,
            'publicFonts' => BaseURL . 'public' . DS . 'webfonts' . DS,
            'publicIMG' => BaseURL . 'public' . DS . 'images' . DS,
            'publicJS' => BaseURL . 'public' . DS . 'js' . DS,
            'publicAngularJS' => BaseURL . 'public' . DS . 'js' . DS . 'angular' . DS,
            'publicBootstrapJS' => BaseURL . 'public' . DS . 'js' . DS . 'bootstrap' . DS,
            'publicJqueryJS' => BaseURL . 'public' . DS . 'js' . DS . 'jquery' . DS,
            'publicJqueryUIJS' => BaseURL . 'public' . DS . 'js' . DS . 'jquery-ui' . DS,
            'public' . ucfirst(DefaultAppName) . 'JS' => BaseURL . 'public' . DS . 'js' . DS . strtolower(DefaultAppName) . DS,
            'publicJSPlugin' => BaseURL . 'public' . DS . 'js' . DS . 'plugin' . DS,
            'rootCSS' => BaseURL . AppSET . DS . 'themes' . DS . $this->template . DS . 'css' . DS,
            'rootIMG' => BaseURL . AppSET . DS . 'themes' . DS . $this->template . DS . 'img' . DS,
            'rootJS' => BaseURL . AppSET . DS . 'themes' . DS . $this->template . DS . 'js' . DS,
            'js' => $js,
            'jsPlugin' => $this->jsPlugin,
            'mediaImage' => WebPublicMediaImagesFolder,
            'logoFolder' => WebPublicMediaLogoImagesFolder,
            'favicon' => $favicon,
            'profilePhotosFolder' => WebPublicMediaProfileImagesFolder,
            'uploads' => WebPublicMediaUploadsFolder,
            'root' => BaseURL,
            'configs' => array(
                'app_name' => AppName,
                'app_slogan' => AppSlogan,
                'app_author' => AppAuthor,
                'app_company' => AppCompany
            )
        );

        if (is_readable($this->roots['view'] . $view . '.tpl')) {

            if ($nolayout) {
                $this->template_dir = $this->roots['view'];
                $this->display($this->roots['view'] . $view . '.tpl');
                exit;
            }
            $this->assign('content', $this->roots['view'] . $view . '.tpl');
        } else {
            Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Page or content not found or page location is wrong.')));
            $this->viewError(
                $this->roots['view'],
                $this->roots['view'] . $view . '.tpl',
                'Not found', 'Page or content not found or page location is wrong.'
            );
        }

        $this->assign('widgets', $this->getWidgets());
        $this->assign('acl', $this->acl);
        $this->assign('layoutParams', $layoutParams);
        $this->display('template.tpl');
    }

    public function setJs(array $js)
    {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->_js[] = $this->roots['js'] . $js[$i] . '.js';
            }
        } else {
            Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'JavaScript file not found or error while loading JavaScript files.')));
            $this->viewError(
                'Javascript file',
                $this->_js[],
                'Not found', 'JavaScript file not found or error while loading JavaScript files.'
            );
        }
    }

    public function selfConfig(array $js)
    {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->_js[] = $this->roots['js'] . $js[$i] . '.js';
            }
        } else {
            Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'JavaScript file not found or error while loading JavaScript files.')));
            $this->viewError(
                'Javascript file',
                $this->_js[],
                'Not found', 'JavaScript file not found or error while loading JavaScript files.'
            );
        }
    }

    public function setJsPlugin(array $js)
    {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->jsPlugin[] = BaseURL . 'public' . DS . 'js' . DS . 'plugin' . DS . $js[$i] . '.js';
            }
        } else {
            Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'JavaScript Plugin file not found or error while loading JavaScript files.')));
            $this->viewError(
                'Javascript file',
                $this->jsPlugin[],
                'Not found', 'JavaScript Plugin file not found or error while loading JavaScript files.'
            );
        }
    }

    public function setModuleTemplate($template)
    {
        $this->template = (string)$template;
    }

    public function widget($widget, $method, $options = array())
    {
        if (!is_array($options)) {
            $options = array($options);
        }

        if (is_readable(WidgetsDIR . $widget . '.php')) {
            include_once WidgetsDIR . $widget . '.php';

            $widgetClass = $widget . 'Widget';

            if (!class_exists($widgetClass)) {
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Widget class not found or Widget class call error.')));
                $this->viewError(
                    $widget . '.php',
                    WidgetsDIR . $widget . '.php',
                    'Not found', 'Widget class not found or Widget class call error.'
                );
            }

            if (is_callable($widgetClass, $method)) {
                if (count($options)) {
                    return call_user_func_array(array(new $widgetClass, $method), $options);
                } else {
                    return call_user_func(array(new $widgetClass, $method));
                }
            }
        }

        Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Widget\'s content not found.')));
        $this->viewError('Widget', 'Required file', 'Not found', 'Widget\'s content not found.');
    }

    public function getLayoutPositions()
    {
        if (is_readable(ThemesDIR . $this->template . DS . 'configs' . DS . 'configs.php')) {
            include_once ThemesDIR . $this->template . DS . 'configs' . DS . 'configs.php';

            return get_layout_positions();
        }

        Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Layout configuration file not found.')));
        $this->viewError(
            'Config.php',
            ThemesDIR . $this->template . 'configs' . DS . 'configs.php',
            'Not found', 'Layout configuration file not found.'
        );
    }

    public function getWidgets()
    {
        $widgets = array(
            'menu-header' => array(
                'config' => $this->widget('menu', 'getConfig', array('header')),
                'content' => array('menu', 'getMenu', array('header', 'header'))
            ),

            'menu-left' => array(
                'config' => $this->widget('menu', 'getConfig', array('left')),
                'content' => array('menu', 'getMenu', array('left', 'left'))
            ),

            'menu-right' => array(
                'config' => $this->widget('menu', 'getConfig', array('right')),
                'content' => array('menu', 'getMenu', array('right', 'right'))
            ),

            'menu-footer' => array(
                'config' => $this->widget('menu', 'getConfig', array('footer')),
                'content' => array('menu', 'getMenu', array('footer', 'footer'))
            )
        );

        $positions = $this->getLayoutPositions();
        $keys = array_keys($widgets);

        foreach ($keys as $k) {
            /* Verification of widgets position visibility. */
            if (isset($positions[$widgets[$k]['config']['position']])) {
                /* Verification it's view disability */
                if (!isset($widgets[$k]['config']['hide']) || !in_array(self::$item, $widgets[$k]['config']['hide'])) {
                    /* Verification it's view visibility */
                    if ($widgets[$k]['config']['show'] === 'all' || in_array(self::$item, $widgets[$k]['config']['show'])) {

                        if (isset($this->widget[$k])) {
                            $widgets{$k}['content'][2] = $this->widget[$k];
                        }

                        /*is it's have position in layout*/
                        $positions[$widgets[$k]['config']['position']][] = $this->getWidgetContent($widgets[$k]['content']);
                    }
                }
            }
        }

        return $positions;
    }

    public function getWidgetContent(array $content)
    {
        if (!isset($content[0]) || !isset($content[1])) {
            Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Widget\'s content not found.')));
            $this->viewError('Widget', 'Required file', 'Not found', 'Widget\'s content not found.');
        }
        if (!isset($content[2])) {
            $content[2] = array();
        }
        return $this->widget($content[0], $content[1], $content[2]);
    }

    public function setWidgetOptions($key, $options)
    {
        $this->widget[$key] = $options;
    }

    public function favicon()
    {
        $favicon = Setting::siteFevicon();
        if (!empty($favicon)) {
            return $favicon;
        }
    }

    public function viewError($file, $url, $status, $message)
    {
        //Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => 'Content not Found.')));
        throw new Exception('<title> Content not found ' . '</title>' .
            '<div style="margin: 0; padding: 0;">' .
            '<div style="font-size: 20px; font-weight: bold;">Content not Found.</div>' .
            '<p> File name:  <b>' . $file . '</b><br/>Location:  <b>' . $url . '</b><br/>' .
            'Status:  <b>' . $status . '</b><br/>Message:  <b>' . $message . '</b><br/></p></div>');
        //header('location:' . BaseURL . 'error/access/404');
    }
}