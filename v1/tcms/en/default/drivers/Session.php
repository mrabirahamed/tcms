<?php

class Session {

    public static function init() {
        session_name(DefaultAppName);
        //session_id(uniqid());
        session_start();
        if (Session::get('auth') === TRUE) {
        if (!isset($_SESSION['RememberMe'])) {
            self::sessionTime();
        }
    }
    }

    public static function destroy($value = FALSE) {
        if($value) {
            if(is_array($value)) {
                for($i = 0; $i < count($value); $i++) {
                    if(isset($_SESSION[$value[$i]])) {
                        unset($_SESSION[$value[$i]]);
                    }
                }
            } else {
                if(isset($_SESSION[$value])) {
                    unset($_SESSION[$value]);
                }
            }
        } else {
            session_destroy();
        }
    }

    public static function set($value, $source) {
        if(!empty($value))
            $_SESSION[$value] = $source;
    }

    public static function get($value) {
        if(isset($_SESSION[$value]))
            return $_SESSION[$value];
    }

    public static function access($level) {
        if(!Session::get('auth')){
			Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => 'User does not loged in.')));
            header('location:' . BaseURL . 'error/access/401');
            exit;
        }

        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))){
			Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => 'User\'s does not level not found.')));
            header('location:' . BaseURL . 'error/access/401');
            exit;
        }
    }

    public static function accessView($level) {
        if(!Session::get('auth')) {
            return FALSE;
        }

        Session::sessionTime();

        if(Session::getLevel($level) > Session::getLevel(Session::get('level'))) {
            return FALSE;
        }

        return TRUE;
    }

    public static function getLevel($level) {
        $role['root'] = 1;
        $role['admin'] = 2;
        $role['stuff'] = 3;
        $role['client'] = 4;

        if(!array_key_exists($level, $role)) {
            throw new Exception('Access error.');
        } else {
            return $role[$level];
        }
    }


    public static function accessRestrict(array $level, $noAdmin = FALSE) {
        if(!Session::get('auth')){
			Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => 'User does not loged in.')));
            header('location:' . BaseURL . 'error/access/401');
            exit;
        }

        Session::sessionTime();

        if($noAdmin === FALSE){
            if(Session::get('level') === 'admin'){
                return;
            }
        }

        if(count($level)){
            if(in_array(Session::get('level'), $level)){
                return;
            }
        }
		
		Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => 'Session time out.')));
		header('location:' . BaseURL . 'error/access/403');
    }

    public static function accessViewRestrict(array $level, $noAdmin = FALSE) {
         if(!Session::get('auth')){
            return FALSE;
        }

        Session::sessionTime();

        if($noAdmin === FALSE){
            if(Session::get('level') === 'admin'){
                return TRUE;
            }
        }

        if(count($level)){
            if(in_array(Session::get('level'), $level)){
                return TRUE;
            }
        }

        return FALSE;
    }

    public static function sessionTime(){
        if(!Session::get('time') || !defined('SessionTime')){
			Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => 'Session Time is not set.')));
            throw new Exception('Session Time is not set');
        }

        if(SessionTime === 0){
            return;
        }

        if(time() - Session::get('time') > (SessionTime * 60)){
            Session::destroy();
			Tracker::addEvent(array( 'activity' => array('messageType' => 'error', 'message' => 'User log out.')));
            header('location:' . BaseURL . 'user/login');
        }
        else {
            Session::set('time', time());
        }
    }
}
