<?php

/*Required directories declared here*/

define('AppSET', 'default');
define('CoreApp', 'core');
define('HashKEY', '57c1d48ba721a');
define('HashKEYforOPENSSL', 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU');
define('TempFolder', ROOT . 'tmp' . DS);
define('AppDIR', ROOT . AppSET . DS);
define('DriversDIR', AppDIR . 'drivers' . DS);
define('LibraryDIR', AppDIR . 'libs' . DS);
define('AppRequiedDataDIR', LibraryDIR . 'data' . DS);
define('ModulesDIR', AppDIR . 'modules' . DS);
define('ThemesDIR', AppDIR . 'themes' . DS);
define('WidgetsDIR', AppDIR . 'widgets' . DS);
define('LibFontDIR', AppDIR . 'libs' . DS . 'fonts' . DS);
define('ImportedDIR', ROOT . 'public' . DS . 'media' . DS . 'import-data' . DS);


/*Required directories of development level declared here*/
define('ImportedFontDIR', ImportedDIR . 'fonts' . DS);
define('PublicMediaLogoImagesFolder', 'public' . DS . 'media' . DS . 'favicon' . DS);

/*Required constant variables declared here*/
define('DefaultAppName', 'Mishusoft');
define('DefaultAppCompanyName', 'Mishu Software Inc');
define('DefaultAppDescription', 'Technology for everyone.');
define('DefaultDataCharSet', 'utf8mb4');
define('DefaultDataTablePrefix', 'msu');
define('SystemDefaultLayout', 'default');
define('AppUsernamePrefix', 'msu_');
define('StaticAdminEmailAddress', 'support@mishusoft.com');
define('StaticContactTitle', 'Feedback');
define('HiddenUser', AppUsernamePrefix . 'root');
define('DefaultController', 'index');
define('SessionTime', 10);


/*Admin's contacts issue declared here*/


Configuration::init();

define('DbHOST', Configuration::$db_host);
define('DbPORT', Configuration::$db_port);
define('DbUSER', Configuration::$db_user);
define('DbPASS', Configuration::$db_pass);
define('DbNAME', Configuration::$db_name);
define('DbCHAR', Configuration::$db_char);
define('DbPREFIX', Configuration::$db_prefix);

Setting::init();

define('BaseURL', Setting::checkedadd());
define('DefaultLayout', Setting::siteDefaultLayout());

define('AppName', Setting::siteName());
define('AppSlogan', Setting::siteDescription());
define('AppAuthor', 'Mr Abir Ahamed' /*Setting::siteCompany()*/);
define('AppCompany', Setting::siteCompany());


/* Required web folders declared here*/

define('WebPublicMediaImagesFolder', BaseURL . 'public' . DS . 'media' . DS . 'images' . DS);
define('WebPublicMediaLogoImagesFolder', BaseURL . 'public' . DS . 'media' . DS . 'favicon' . DS);
define('WebPublicMediaProfileImagesFolder', BaseURL . 'public' . DS . 'media' . DS . 'profiles_photos' . DS);

define('WebPublicMediaUploadsFolder', BaseURL .  'public' . DS . 'media' . DS . ' uploads ' . DS);

class Configuration
{

    public static $db_host;
    public static $db_port;
    public static $db_user;
    public static $db_pass;
    public static $db_name;
    public static $db_char;
    public static $db_prefix;
    public static $init;

    public function __construct()
    {
        self::$db_host = null;
        self::$db_port = null;
        self::$db_user = null;
        self::$db_pass = null;
        self::$db_name = null;
        self::$db_char = null;
        self::$db_prefix = null;
    }

    public static function init()
    {
        if (!self::$init instanceof self) {
            self::$init = new Configuration();
        }

        self::connection();
        return self::$init;
    }

    private static function connection()
    {
        if (empty(self::$db_host || self::$db_user || self::$db_pass || self::$db_name || self::$db_char || self::$db_prefix)) {

            System::activate();
            if (System::$SetupStatus === "ok") {
                self::$db_host = System::GetConfData("db_host");
                self::$db_port = System::GetConfData("db_port");
                //self::$db_port = "3306";
                self::$db_user = System::GetConfData("db_user");
                self::$db_pass = System::GetConfData("db_pass");
                self::$db_name = System::GetConfData("db_name");
                self::$db_char = System::GetConfData("db_char");
                self::$db_prefix = System::GetConfData("db_prefix");

            } else {
                System::setupUI();
            }
        }
    }
}
