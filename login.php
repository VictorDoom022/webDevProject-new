<?php
require_once('config/connect_db.php');
require_once('config/bootstrap.php');
require_once('customer/layouts.php');

session_start();

if(isset($_SESSION['username'])) {
	if($_SESSION['position'] == 'customer') {
		header('location: index.php');
	}
}

do_html_head('APP NAME', $bootstrapCSS.'<link rel="stylesheet" type="text/css" href="css/style.css">', $bootstrapJS);
do_component_topnav('APP NAME');
?>
<style>

</style>
<div class="login-box">
	<form method="post" action="functions/login_function.php">
		<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;margin: auto;">
			<tr>
				<td>
					<table border="0" cellpadding="0" cellspacing="0" style="width: 1200px;margin: auto;">
						<tr>
							<td>
								<table class="login_table" style="position: relative;">
									<tr>
										<td style="width: 100%;" colspan="2">
											<h1>
											Login To  Apple.Com
											</h1>
											
										</td>
									</tr>
									<tr>
										<td style="bottom: 12px;position: relative;padding-bottom: 35px;">
											<span class="word">Or</span> <a style="text-decoration: none;color: #c46a10;" href="guest/register.php" alt="Sign up now" title="Sign up now">Sign up now</a>
										</td>
									</tr>
									<tr>
										<td class="td_content" colspan="2"><input class="input_box" type="text" name="username" placeholder="Username"></td>
									</tr>
									<tr>
										<td class="td_content"colspan="2"><input class="input_box" type="password" name="password" placeholder="Password"></td>
									</tr>
									<tr>
										<td style="text-align: center;" colspan="2">
											<?= (isset($_SESSION['error'])) ? '<div class="text-danger">'. $_SESSION['error'] .'</div>' : '' ?>
											<?php unset($_SESSION['error']); ?>
										</td>
									</tr>
									<tr>
										<td style="text-align: center;" colspan="2">
											<?= (isset($_SESSION['success'])) ? '<div class="text-success" style="text-align:center;">'. $_SESSION['success'] .'</div>' : '' ?>
											<?php unset($_SESSION['success']); ?>
										</td>
									</tr>
									<tr>
										<td class="td_content"colspan="2"><input type="checkbox" id="term" name="term" value="value1" checked>
	<label class="word">I had read the Term and Condition</label><br>
									</tr>
									<br>
									<tr>
										<td class="td_content"><input type="submit"name="login" value="login" class="button1" alt="Login" title="Login">
										</td>
										<td>
											<a value="login" alt="Forgot Username or Password？" title="Forgot Username or Password？"href="forgot_password.php" style="text-decoration: none;color: #c46a10;">Forgot Username or Password</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		</form>
    </div>
<?php
do_html_end();
?>