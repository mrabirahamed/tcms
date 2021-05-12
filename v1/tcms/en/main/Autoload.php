<?php

function autoLoadCore($class) {
    if (file_exists(DriversDIR . ucfirst(strtolower($class)) . '.php')) {
        include_once DriversDIR . ucfirst(strtolower($class)) . '.php';
    }
}

function autoLoadLibs($class) {
    if (file_exists(LibraryDIR . 'class.' . strtolower($class) . '.module')) {
        include_once LibraryDIR . 'class.' . strtolower($class) . '.module';
    }
}

function autoLoadThirdPartyLibs($class) {
    if (file_exists(LibraryDIR . 'thirdparty' . DS . 'class.' . strtolower($class) . '.module')) {
        include_once LibraryDIR . 'thirdparty' . DS . 'class.' . strtolower($class) . '.module';
    }
    if (file_exists(LibraryDIR . 'thirdparty' . DS . strtolower($class) . DS . 'class.' . strtolower($class) . '.module')) {
        include_once LibraryDIR . 'thirdparty' . DS . strtolower($class) . DS . 'class.' . strtolower($class) . '.module';
    }
}

spl_autoload_register('autoLoadCore');
spl_autoload_register('autoLoadLibs');
spl_autoload_register('autoLoadThirdPartyLibs');
