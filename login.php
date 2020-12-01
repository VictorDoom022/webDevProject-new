<?php
require_once('config/bootstrap.php');
require_once('customer/layouts.php');

session_start();

if(isset($_SESSION['username'])) {
	if($_SESSION['position'] == 'customer') {
		header('location: index.php');
	}
}

do_html_head('APP NAME', $bootstrapCSS, $bootstrapJS);
do_component_topnav('APP NAME');
?>
	<div class="container-fluid">
		<div class="row justify-content-center mt-5">
			<div class="col-md-6">
				<div class="card border-0 shadow-sm">
					<div class="card-header bg-white">
						<h4>Login</h4>
					</div>
					<div class="card-body">
						<form method="post" action="functions/login_function.php">
							<div class="row">
								<div class="col-md-12">
									Username: 
									<input type="text" class="form-control" name="username">
								</div>
								<div class="col-md-12">
									Password: 
									<input type="password" class="form-control" name="password">
								</div>
								<div class="col-md-12 mt-2 text-right">
									<input type="submit" class="btn btn-primary" name="login" value="login"/>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>	
		</div>
	</div>
<?php
do_html_end();
?>