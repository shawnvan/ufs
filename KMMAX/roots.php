<?php
    define('IS_LINUX', PHP_OS == 'Linux');
    define('IS_WINNT', PHP_OS == 'WINNT');
    define('IS_OSX', PHP_OS == 'Darwin');
    
    // The application has only been tested in Linux, and
    // Windows variants identifying themselves as WINNT.
    assert(IS_LINUX || IS_WINNT || IS_OSX); // Not Coding Standard

    define('COMMON_ROOT',   dirname(__FILE__));
    define('INSTANCE_ROOT', getcwd());
?>
