<?php
// Cookies are dependent on request-responce cycle
// php set cookie function takes 3 arguments
$name = 'demo';
$value = '14';
$expire = time() + (60*60*24*7);
setcookie($name,$value, $expire);


// How to destroy a cookie
setcookie($name, null, time() - 7000);

// name = you decide
// value = value for the name (key=>value)
// expire = must be unix time stamp

$demo= $_COOKIE['demo'];
    echo $demo;