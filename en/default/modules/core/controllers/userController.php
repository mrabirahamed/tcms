<?php

class userController extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = $this->loadModel('user');
    }

    public function index()
    {
        $this->access_init();
        Tracker::addEvent(array('activity' => array('messageType' => 'success', 'message' => 'Navigate user page successfully')));
        $this->view->setJs(['main']);
        $this->view->assign('user', $this->user->getLogedInUserDetails(Session::get('id_user')));
        $this->view->assign('title', 'My home');
        $this->view->render('index', 'My home');
    }

    private function catchRedirectURL($value)
    {
        if (isset($_GET[$value]) && !empty($_GET[$value])) {
            return $_GET[$value];
        }
    }

    public function login()
    {
        $this->view->setJs(['main']);
        $this->view->assign('title', 'Log In');

        if (Session::get('auth')) {
            $this->redirectURI($this->catchRedirectURL('redirect'));
        }

        if ($this->catchRedirectURL('redirect')) {
            $this->view->assign('notify', 'Please log in to continue.');
            Tracker::addEvent(array('activity' => array('messageType' => 'notify', 'message' => 'Please log in to continue.')));
        }

        if ($this->getInt('logged') === 1) {
            $this->view->assign('datas', $_POST);

            if (!$this->getAlphaNum('username')) {
                $this->view->assign('error', 'Please input your username.');
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Empty username.')));
                $this->view->render('login', 'Login');
                exit;
            }

            if (!$this->getSql('password')) {
                $this->view->assign('error', 'Please input your password.');
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Empty password.')));
                $this->view->render('login', 'Login');
                exit;
            }

            if (!$this->user->getUserName($this->getAlphaNum('username'))) {
                $this->view->assign('error', 'Your username not exist. Please create a new account.');
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Your username not exist. Please create a new account. This user try with (username = ' . $this->getAlphaNum('username') . ')')));
                $this->view->render('login', 'Login');
                exit;
            }

            $UserPassWord = $this->user->getUserPassWord($this->getAlphaNum('username'));

            if (Hash::passwordDECRYPT($UserPassWord) !== $this->getSql('password')) {
                $this->view->assign('error', 'Incorrect password. Please try with correct password.');
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Incorrect password. This user try with (password = ' . $this->getSql('password') . ')')));
                $this->view->render('login', 'Login');
                exit;
            }

            $row = $this->user->getUser(
                $this->getAlphaNum('username'),
                $this->getSql('password')
            );

            if (!$row) {
                $this->view->assign('error', 'Login fail. Incorrect username & password.');
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Login fail. Invalid or incorrect username & password. Try username:' . $this->getAlphaNum('username') . '. Try pass:' . $this->getSql('password'))));
                $this->view->render('login', 'Login');
                exit;
            }

            if ($row['status'] !== 1) {
                $this->view->assign('error', 'Username inactive now. If you want to access your current account,'
                    . ' you will need to active your account. Recently we have been already sent to your e-mail an activation code.');
                Tracker::addEvent(array('activity' => array('messageType' => 'error', 'message' => 'Login fail. Invalid or incorrect username & password. Try username:' . $this->getAlphaNum('username') . '. Try pass:' . $this->getSql('password'))));
                $this->view->render('login', 'Login');
                exit;
            }

            $this->user->userNewLog($row['id'], 'LOGIN');

            Session::set('auth', TRUE);
            Session::set('level', $row['role']);
            Session::set('username', $row['username']);
            Session::set('f_name', $row['f_name']);
            Session::set('l_name', $row['l_name']);
            Session::set('id_user', $row['id']);
            Session::set('time', time());
            Session::set('RememberMe', $this->getText("RememberMe"));
            Session::set('BranchName', $this->user->getBranchNameById($this->user->getBranchIdByUserId($row['id'])));

            Tracker::addEvent(array('activity' => array('messageType' => 'success', 'message' => 'Login successfully. Try username:' . $this->getAlphaNum('username') . '. Try pass:' . $this->getSql('password'))));
            $this->redirectURI($this->catchRedirectURL('redirect'));
        }

        $this->view->render('login', 'Login');
    }

    public function registration()
    {
        if (Session::get('auth')) {
            $this->redirect();
        }

        $this->view->setJs(['main']);
        $this->view->assign('title', 'Sign Up');

        if ($this->getInt('regs') === 1) {
            $this->view->assign('datas', $_POST);

            if (!$this->getSql('f_name')) {
                $this->view->assign('error', 'Please enter your first name.');
                $this->view->render('registration', 'Register');
                exit;
            }

            if (!$this->getSql('l_name')) {
                $this->view->assign('error', 'Please enter your last name.');
                $this->view->render('registration', 'Register');
                exit;
            }

            if (!$this->getAlphaNum('username')) {
                $this->view->assign('error', 'Please enter your username.');
                $this->view->render('registration', 'Register');
                exit;
            }

            if ($this->user->getUserName($this->getAlphaNum('username'))) {
                $this->view->assign('error', 'The username <b>' . $this->getAlphaNum('username') . '</b> has already exist. Please enter new one.');
                $this->view->render('registration', 'Register');
                exit;
            }

            if (!$this->validEmail($this->getWordParam('email'))) {
                $this->view->assign('error', 'Entered email address already registered. Please enter new email address.');
                $this->view->render('registration', 'Register');
                exit;
            }

            if ($this->user->varifyEmail($this->getWordParam('email'))) {
                $this->view->assign('error', '<b>' . $this->getWordParam('email') . '</b> has been already registered.');
                $this->view->render('registration', 'Register');
                exit;
            }

            if (!$this->getSql('password')) {
                $this->view->assign('error', 'Please enter your password.');
                $this->view->render('registration', 'Register');
                exit;
            }

            if ($this->getWordParam('password') != $this->getWordParam('c_password')) {
                $this->view->assign('error', 'Your entered password does not match. Please enter your same password.');
                $this->view->render('registration', 'Register');
                exit;
            }

            $this->user->addUser(
                $this->getSql('f_name'),
                $this->getSql('l_name'),
                $this->getWordParam('email'),
                $this->getSql('password'),
                $this->getAlphaNum('username')
            );

            $username = $this->user->varifyusername($this->getAlphaNum('username'));

            if (!$username) {
                $this->view->assign('error', 'Registration could not Complete.');
                $this->view->render('registration', 'Register');
                exit;
            }

            Mail::send([
                    "sender" => [
                        "name" => AppCompany,
                        "email" => "info@misu.com.bd",
                    ],
                    "receiver" => [
                        "name" => $this->getSql('f_name') . "&nbsp;" . $this->getSql('l_name'),
                        "email" => $this->getWordParam('email'),
                    ],
                    "replyTo" => [
                        "name" => AppCompany,
                        "email" => "info@misu.com.bd",
                    ],
                    "cc" => [
                        "name" => "abir ahamed",
                        "email" => "abir.ahamed@outlook.com",
                    ],
                    "bcc" => [
                        "name" => "abir ahamed",
                        "email" => "abir.ahamed@outlook.com",
                    ],
                    "subject" => "Active your account",
                    "body" => 'Hello <strong>' . $this->getSql('f_name') . '</strong> .' .
                        '<p> You have been recently created a account in <strong>' . AppCompany . '</strong>. But ' .
                        'your account inactive now and it will be inactive untill activation of your account. ' .
                        'So your must need active your account for use it and enjoy our all facilities. ' .
                        '<a href = "' . BaseURL . 'user/membershipActivation/' . $username['id'] . '/' . $username['code'] .
                        '">' . BaseURL . 'user/reg/activation/' . $username['id'] . '/' . $username['code'] .
                        '</a>.</p>',
                    "altbody" => "<p>Service Porvider could not support HTML.</p>",
                ]
            );

            $this->view->assign('datas', FALSE);
            $this->view->assign('success', 'New user <b>' . $this->getSql('f_name') .
                '</b> has been registered successfully and we send an email to your email address <b>' .
                $this->getWordParam('email') . '</b>. Receive the mail and active your valuable account.');

            //$this->redirect('user/reg/next');
        }
        $this->view->render('registration', 'Register');
    }

    public function next()
    {
        /*start test coding*/
        $image = '';

        if (isset($_FILES['image']['name'])) {
            $media = ROOT . 'public' . DS . 'media' . DS . 'uploads' . DS;
            $upload = new upload($_FILES['image']);
            $upload->allowed = ['image/*'];
            //$upload->file_new_name_body = 'upl_' . uniqid();
            $upload->process($media);

            if ($upload->processed) {
                $image = $upload->file_dst_name;;
                $thumb = new upload($upload->file_dst_pathname);
                $thumb->image_resize = TRUE;
                $thumb->image_x = 100;
                $thumb->image_y = 70;
                $thumb->file_name_body_pre = 'thumb_';
                $thumb->process($media . 'thumbs' . DS);
            } else {
                $this->view->assign('error', $upload->error);
                $this->view->render('next', 'Register');
                exit;
            }
        }

        $this->view->assign('title', 'Complete your profile!');
        $this->view->render('next', 'Register');
    }

    public function membershipActivation($id, $code)
    {
        $this->view->assign('title', 'Account activation');


        if (!$this->filterInt($id) || !$this->filterInt($code)) {
            $this->view->assign('error', 'This code <strong>' . $this->filterInt($code) . '</strong> of active <strong>' . $this->filterInt($id) . '<strong> account does not exist.');
            $this->view->render('membershipActivation', 'Registration');
            exit;
        }

        $row = $this->user->getInactiveUSER(
            $this->filterInt($id),
            $this->filterInt($code)
        );

        if (!$row) {
            $this->view->assign('error', 'This code <strong>' . $this->filterInt($code) . '</strong> of active <strong>' . $this->filterInt($id) . '</strong> account does not exist.');
            $this->view->render('membershipActivation', 'Registration');
            exit;
        }

        if ($row['status'] === 1) {
            $this->view->assign('error', 'This user already activated.');
            $this->view->render('membershipActivation', 'Registration');
            exit;
        }

        $this->user->activeUser(
            $this->filterInt($id),
            $this->filterInt($code)
        );

        $row = $this->user->getUser(
            $this->filterInt($id),
            $this->filterInt($code)
        );

        if ($row['status'] === 0) {
            $this->view->assign('error', 'Failed to active the <b>' . $this->getSql('name') . '</b> user\' account.');
            $this->view->render('membershipActivation', 'Register');
            exit;
        }

        $this->view->assign('success', 'New user <b>' . $this->getSql('name') . '</b> has been actived successfully.');
        $this->view->render('membershipActivation', 'Registration');
    }

    public function pswrdRecovery()
    {
        if (Session::get('auth')) {
            $this->redirect();
        }

        $this->view->setJs(['main']);
        $this->view->assign('title', 'Password recovery');

        if ($this->getInt('enviar') === 1) {
            $this->view->assign('datas', $_POST);

            if (!$this->validEmail($this->getWordParam('email'))) {
                $this->view->assign('error', 'Entered email address already registered. Please enter new email address.');
                $this->view->render('pswrdRecovery', 'Password recovery');
                exit;
            }
            if (!$this->user->varifyEmail($this->getWordParam('email'))) {
                $this->view->assign('error', '<b>' . $this->getWordParam('email') . '</b> is not registered yet.');
                $this->view->render('pswrdRecovery', 'Password recovery');
                exit;
            }

            $this->user->addNewCode($this->getWordParam('email'));
            $user = $this->user->getUserByEmail($this->getWordParam('email'));

            Mail::send([
                    "sender" => [
                        "name" => AppCompany,
                        "email" => "info@misu.com.bd",
                    ],
                    "receiver" => [
                        "name" => $this->getSql('f_name') . "&nbsp;" . $this->getSql('l_name'),
                        "email" => $this->getWordParam('email'),
                    ],
                    "replyTo" => [
                        "name" => AppCompany,
                        "email" => "info@misu.com.bd",
                    ],
                    "cc" => [
                        "name" => "abir ahamed",
                        "email" => "abir.ahamed@outlook.com",
                    ],
                    "bcc" => [
                        "name" => "abir ahamed",
                        "email" => "abir.ahamed@outlook.com",
                    ],
                    "subject" => "Active your account",
                    "body" => 'Hello <strong>' . $user['f_name'] . '</strong> .' .
                        '<p> You have a account in <strong>' . AppCompany . '</strong>. But ' .
                        'your account inactive now and it password reseted. It will be inactive until activation of your account. ' .
                        'So your must need active your account for use it and enjoy our all facilities. ' .
                        '<a href = "' . BaseURL . 'user/membershipActivation/' . $user['id'] . '/' . $user['code'] .
                        '">' . BaseURL . 'user/reg/activation/' . $user['id'] . '/' . $user['code'] .
                        '</a>.</p>',
                    "altbody" => "<p>Service Porvider could not support HTML.</p>",
                ]
            );

            $this->view->assign('datas', FALSE);
            $this->view->assign('success', 'New user <b>' . $user['f_name'] .
                '</b> has been registered successfully and we send an email to your email address <b>' .
                $this->getWordParam('email') . '</b>. Receive the mail and active your valuable account.');
        }

        $this->view->render('pswrdRecovery', 'Password recovery');
    }

    public function logout()
    {
        /*$log = $this->user->userNewLog(Session::get('id_user'), 'LOGOUT');
        if ($log) {Session::destroy();$this->redirect();}*/
        Session::destroy();
        $this->redirect();
    }

    public function checkValidUsername()
    {
        if (!$this->getAlphaNum('username')) {
            echo json_encode([
                [
                    'type' => 'error',
                    'message' => 'Please fil out your username.',
                ],
            ]);
            exit;
        }
        if ($this->user->getUserName($this->getAlphaNum('username'))) {
            echo json_encode([
                [
                    'type' => 'error',
                    'message' => 'The username <b>' . $this->getAlphaNum('username') . '</b> has already exist. Please enter new one.',
                ],
            ]);
            exit;
        }

        echo json_encode([
            [
                'type' => 'success',
                'message' => '<b>' . $this->getAlphaNum('username') . '</b> is available',
            ],
        ]);
        exit;
    }

    public function checkValidEmailAddress()
    {
        if (!$this->getWordParam('email')) {
            echo json_encode([
                [
                    'type' => 'error',
                    'message' => 'Please fil out your email address.',
                ],
            ]);
            exit;
        }


        if (!$this->validEmail($this->getWordParam('email'))) {
            echo json_encode([
                [
                    'type' => 'error',
                    'message' => 'User\'s email address(' . $this->getWordParam('email') . ') is  not valid.',
                ],
            ]);
            exit;
        }

        if ($this->user->varifyEmail($this->getWordParam('email'))) {
            echo json_encode([
                [
                    'type' => 'error',
                    'message' => 'User\'s email address(' . $this->getWordParam('email') . ')  already registered. Please enter new email address.',
                ],
            ]);
            exit;
        }

        echo json_encode([
            [
                'type' => 'success',
                'message' => '<b>' . $this->getWordParam('email') . '</b> is available',
            ],
        ]);
        exit;
    }

    public function activities()
    {
        $this->acl->access('edit_user_acitivities');
        //Tracker::addEvent(array('activity' => array('messageType' => 'success','message' => 'Navigate to users page successfully')));

        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->assign('activities', $pagination->pager($this->user->notificationsAll()));
        $this->view->assign('pagination', $pagination->getView('ajax'));

        $this->view->setJs(['main']);
        $this->view->assign('title', 'User Activities');
        $this->view->render('activities', 'User Activities');
    }

    public function activitiesPaginationAJAX()
    {
        $page = $this->getInt('page');

        $this->getLibrary('pagination');
        $pagination = new Pagination();

        $this->view->assign('activities', $pagination->pager($this->user->notificationsAll(), $page));
        $this->view->assign('pagination', $pagination->getView('ajax'));
        $this->view->render('activities_p_ajax', false, true);
    }

    public function checkLogStatus()
    {
        if (Session::get('auth')) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
