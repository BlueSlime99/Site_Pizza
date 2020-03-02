<?php


$authTableData = [
    'table' => 'users',
    'idfield' => 'login',
    'cfield' => 'mdp',
    'uidfield' => 'uid',
    'rfield' => 'role',
];

$pathFor = [
    "login"  => "/l2-prog_web-projet4/trame_auth/login.php",
    "logout" => "/l2-prog_web-projet4/trame_auth/logout.php",
    "adduser" => "/l2-prog_web-projet4/trame_auth/adduser.php",
    "root"   => "/l2-prog_web-projet4/trame_auth//",
];

const SKEY = '_Redirect';