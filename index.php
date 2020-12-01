<?php
require_once('config/bootstrap.php');
require_once('customer/layouts.php');

session_start();

do_html_head('APP NAME', $bootstrapCSS, $jQueryJS.$bootstrapJS);
do_component_topnav('APPNAME');
do_html_end();
