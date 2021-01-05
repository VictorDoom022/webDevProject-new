<?php
require_once('./config/app.php');
require_once('./config/connect_db.php');
require_once('./config/bootstrap.php');
require_once('./customer/layouts.php');

session_start();

do_html_head($app_name, $bootstrapCSS, $jQueryJS.$bootstrapJS.$fontAwsomeIcons);
do_component_topnav($app_name);
?>
<div>show order history and status</div>
<?php
do_html_end();