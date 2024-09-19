<?php
ob_start();

header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
function check()
{
    echo 'true';

}

check();
?>