<?php
require_once('../config/bootstrap.php');
require_once('../customer/layouts.php');

session_start();

if(isset($_SESSION['username'])) {
	if($_SESSION['position'] == 'customer') {
		header('location: index.php');
	}
}


do_html_head('APP NAME', $bootstrapCSS, $bootstrapJS);
do_component_topnav('APP NAME');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body style="background-color: #000">
<div class="login-box">
<form method="post" action="login_function.php">
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
										Login To Victor.Com
										</h1>
										
									</td>
								</tr>
								<tr>
									<td style="bottom: 12px;position: relative;padding-bottom: 35px;">
										<span class="word">Or</span> <a class="orange_word" href="register.php" >Sign in now</a>
									</td>
								</tr>
								<tr>
									<td class="td_content" colspan="2"><input class="input_box" type="text" name="username" placeholder="Username"></td>
								</tr>
								<tr>
									<td class="td_content"colspan="2"><input class="input_box" type="password" name="password" placeholder="Password"></td>
								</tr>
								<tr>
									<td class="td_content"colspan="2"><input type="checkbox" id="term" name="term" value="value1" checked>
<label class="word">I had read the Term and Condition</label><br>
								</tr>
								<br>
								<tr>
									<td class="td_content"><input type="submit"name="submit" value="login" class="button1">
									</td>
									<td>
										<a class="orange_word" value="login" alt="Forgot Username or Password？" title="Forgot Username or Password？">Forgot Username or Password</a>
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


</body>
</html>

<?php
do_html_end();
?>