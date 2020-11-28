<?php
require_once('config/bootstrap.php');
require_once('customer/layouts.php');

do_html_head('APP NAME', $bootstrapCSS, $bootstrapJS);
do_component_topnav('APPNAME');
do_html_end();
